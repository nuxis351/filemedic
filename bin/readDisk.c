#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdint.h>
#include <inttypes.h>

int convertLEtoBE2(char * bits);
int convertLEtoBE4(char * bits);
int getOneByte(char * bits);

int main(int argc, char ** argv){
    //File pointers
    FILE * disk; //user-uploaded file. make sure it's readable
    disk = fopen(argv[1], "r");
    if (disk == NULL){
        printf("There is error opening the file!\n");
        exit(0);
    }

    //images location
    char * location = "../images/";

    //Variables
    char vbr[513]; //sector 0. 512 bytes + null-terminating character = 513 bytes
    char buffer[3];
    int BPS; //bytes per sector
    int SPC; //sectors per cluster
    int RSC; //reserved sector count
    int FAT; //number of sectors per FAT

    //Get the VBR
    fread(vbr, 1, 512, disk);

    //Get the SPC
    SPC = vbr[13];

    //Get the BPS
    buffer[0] = vbr[11];
    buffer[1] = vbr[12];
    buffer[2] = '\0';
    BPS = convertLEtoBE2(buffer);

    //Get the RSC
    buffer[0] = vbr[14];
    buffer[1] = vbr[15];
    buffer[2] = '\0';
    RSC = convertLEtoBE2(buffer);

    //Get the FAT
    buffer[0] = vbr[22];
    buffer[1] = vbr[23];
    buffer[2] = '\0';
    FAT = convertLEtoBE2(buffer);

    //go to root directory
    fseek(disk, (RSC + FAT + FAT) * BPS, SEEK_SET);

    //search through root directory for entries
    int moreRdEntries = 1; //flag for existence of rd entries
    int rdEntries = 0; //# of rd entries
    int rdPosition;
    while (moreRdEntries){
        unsigned char rdEntry[33]; //32 bytes per entry of root directory + null-terminating character
        fread(rdEntry, 1, 32, disk);
        rdPosition = ftell(disk);
        if (rdEntry[0] == 0x00){  //this indicates root entry read is empty
            moreRdEntries = 0; //so there is no more rd entries. this is assuming root directory entries are contiguous
        } else if (rdEntry[0] != 0xe5){
            /* printf("%s\n", "Not a deleted file!"); */
        } 
        else{
            rdEntries++;
            rdEntry[0] = 0x5f; //since the first byte of RD entry is "deleted", use 5f to indicate restored file
            unsigned char fileName[9]; //bytes 0 - 7 of RD entry
            unsigned char fileExt[4]; //bytes 8 - 10 of RD entry
            unsigned char fullFileName[13];
            unsigned char startingClusterBuffer[3]; //bytes 26-27
            unsigned char fileSizeBuffer[5]; //bytes 28-31
            int startingCluster, fileSize;

            //get filename
            int i;
            for (i = 0; i < 8; i++){
                fileName[i] = rdEntry[i];
            }
            fileName[8] = '\0';

            for (i = 0; i < 8; i++){
                if (fileName[i] == 0x20){
                    fileName[i] = '\0';
                }
            }

            for (i = 8; i < 11; i++){
                fileExt[i - 8] = rdEntry[i];
            }
            fileExt[3] = '\0';

            strcpy(fullFileName, fileName);
            strcat(fullFileName, ".");
            strcat(fullFileName, fileExt);

            //get starting cluster
            for (i = 26; i < 28; i++){
                startingClusterBuffer[i - 26] = rdEntry[i];
            }
            startingClusterBuffer[2] = '\0';
            startingCluster = convertLEtoBE2(startingClusterBuffer);

            //get file size
            for (i = 28; i < 32; i++){
                fileSizeBuffer[i - 28] = rdEntry[i];
            }
            fileSizeBuffer[4] = '\0';
            fileSize = convertLEtoBE4(fileSizeBuffer);

            //get the data
            fseek(disk, (RSC + FAT + FAT + 32 + ((startingCluster - 2) * SPC)) * BPS, SEEK_SET); //start of data
            int position = ftell(disk);

            char fileBuffer[fileSize + 1];
            fileBuffer[fileSize] = '\0';
            fread(fileBuffer, 1, fileSize, disk);

            FILE * file;
            char finalLocation[100];
            strcpy(finalLocation, location);
            strcat(finalLocation, fullFileName);

            printf("%s\n", fullFileName);

            file = fopen(finalLocation, "w+");
            if (file == NULL){
                printf("%s\n", "Error opening the file to write to!");
                exit(0);
            }
            int bytesWritten = fwrite(fileBuffer, 1, fileSize, file);

            if ( (fwrite(fileBuffer, 1, fileSize, file)) != fileSize){
                printf("%s\n", "Wrote incorrect number of bytes!");
                exit(0);
            } else{
                /* printf("%s%d\n", "Written bytes: ", fileSize); */
            }
        }
        fseek(disk, rdPosition, SEEK_SET);
    }

    //always close file pointers
    fclose(disk);
}

//converts Little Endian to Big Endian for integers to be read correctly (2 bytes)
int convertLEtoBE2(char * bits){
    uint32_t b0 = ((uint32_t) bits[0] & 0x000000ff);
    uint32_t b1 = ((uint32_t) bits[1] & 0x000000ff);

    b1 = b1 << 8;
    return b0 | b1;
}

int convertLEtoBE4(char * bits){
    uint32_t b0 = ((uint32_t) bits[0] & 0x000000ff);
    uint32_t b1 = ((uint32_t) bits[1] & 0x000000ff);
    uint32_t b2 = ((uint32_t) bits[2] & 0x000000ff);
    uint32_t b3 = ((uint32_t) bits[3] & 0x000000ff);

    b1 = b1 << 8;
    b2 = b2 << 16;
    b3 = b3 << 24;

    return b0 | b1 | b2 | b3;
}

int getOneByte(char * bits){
    uint16_t b0;
    b0 = bits[0];

    return b0;
}
