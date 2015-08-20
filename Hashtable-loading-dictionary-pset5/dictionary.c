/****************************************************************************
 * dictionary.c
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Implements a dictionary's functionality.
 ***************************************************************************/

#include <stdbool.h>
#include <string.h>
#include <stdlib.h>
#include <stdio.h>
#include "dictionary.h"
#include <ctype.h>


// struct for a node of linked list
typedef struct node
{
    char word[LENGTH+1];
    struct node* next;
}
node; 

// set a constant for tablesize of hashtable
#define TABLESIZE 100000

// declare number_of_words
int numWords = 0;

// prototype for the hash function
int hash(char* needs_hashing);

// declare global hashtable variable
node* hashtable[TABLESIZE]={NULL};

/**
 * Returns true if word is in dictionary else false.
 */
bool check(const char* word)
{
    // make a copy of the word so we can lowercase it
    char* copy = malloc(strlen(word) * sizeof(char));
    strcpy(copy, word);

    // make all chars in copy lowercase
    for (int i = 0; i < strlen(word); i++)
    {
        if (!islower(copy[i]))
        {
            copy[i] = tolower(copy[i]);
        }
    }
    
    // put copy in hash function to get bucket
    int bucket = hash(copy);

    // declare a pointer as the current bucket
    node* current = hashtable[bucket];

    // if current bucket isn't NULL, check the words in the linked list
    while (current != NULL)
    {
        if (strcmp(current->word, copy) == 0)
        {
            // make sure to free your copy
            free(copy);
            return true;
        }

        // go through each link
        current = current->next;

    }
    // if you go through all links, return false
    return false;
}

/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */
bool load(const char* dictionary)
{
    // open up the file
    FILE* file = fopen(dictionary, "r");
    if (file == NULL)
    {
        printf("Could not load dictionary\n");
        return false;
    }

    char dict_word[LENGTH + 1];
    
    // start loop to scan dictionary word for word
    while(fscanf(file, "%s", dict_word) == 1)
    {
        // add one to numWords
        numWords ++;

        // declare a newnode and give it a size
        node* newnode = malloc(sizeof(node));
        // set dictionary word as the newnode's word
        strcpy(newnode->word, dict_word);
        
        // get the index of the array that word should be in
        int index = hash(newnode->word);

        // if that space is empty, put newnode in that place
        if (hashtable[index] == NULL)
        {
            hashtable[index] = newnode;
            newnode->next = NULL;
        }
        // if that space is already taken by linked list
        else 
        {
            newnode->next = hashtable[index];
            hashtable[index] = newnode;
        }   
        
    }
    fclose(file);
    return true;

}

/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded.
 */
unsigned int size(void)
{
    return numWords;
}

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
bool unload(void)
{
    for (int i = 0; i < TABLESIZE; i++)
    {
        node* cursor = hashtable[i];
        while (cursor != NULL)
        {
            node* temp = cursor;
            cursor = cursor->next;
            free(temp);
        }
    }
    return true;
}


// hashfunction implementation
int hash(char* needs_hashing)
{
    unsigned int hash = 0;
    for (int i=0, n=strlen(needs_hashing); i<n; i++)
        hash = (hash << 2) ^ needs_hashing[i];
    return hash % TABLESIZE;
}
