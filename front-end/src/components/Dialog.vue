<template>
    <v-container>
        <div class="text-center">
            <v-dialog
                :v-model="showDialog"
                width="auto"
            >
                <v-card>
                    <v-card-text>
                        
                    </v-card-text>
                    <v-card-actions>
                        <h1>asokdoaks</h1>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div>
    </v-container>
</template>

<script>
export default{

    props: ['showDialog']
}
</script>