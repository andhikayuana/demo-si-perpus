<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ header }} </div>

                    <div class="card-body">
                        {{ body }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['header', 'body'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
