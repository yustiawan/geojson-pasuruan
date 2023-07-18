<?php
?>
<script>
    $(function(){
        var map = L.map('map').setView([-7.6839, 112.8255], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        @if(@$fileKecamatan!=''&&count($fileKecamatan)>0)
            @foreach($fileKecamatan as $kec)
            fetch('{{ $kec['filegeojson'] }}')
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    L.geoJSON(data, {
                        style: function(feature) {
                            return {
                                color: '#ff0000',
                                weight: 2,
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            layer.bindPopup(feature.properties.name);
                        }
                    }).addTo(map);
                });
            @endforeach
        @endif


        fetch('pasuruan/gempol.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#00ff00',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/beji.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#009900',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/gondangwetan.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#880088',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/grati.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#ff00ff',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/kejayan.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#345500',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/kraton.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#345500',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/lekok.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#345500',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/lumbang.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#345500',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/nguling.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#345500',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/pandaan.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#345500',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/pasrepan.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'red',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/pohjentrek.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'yellow',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/prigen.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'green',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/purwodadi.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'magenta',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/purwosari.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'red',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/puspo.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'blue',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/rejoso.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'green',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/rembang.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'yellow',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/sukorejo.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'yellow',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/tosari.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'yellow',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/tutur.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'yellow',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/winongan.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'yellow',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.name);
                    }
                }).addTo(map);
            });
        fetch('pasuruan/wonorejo.geojson')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            color: 'yellow',
                            weight: 2,
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        var tb='<table style="width:200px">'
                        tb+='<tr><td colspan="2">Kecamatan '+feature.properties.Kecamatan+'</td></tr>'
                        tb+='<tr><td style=""  >Penerima BPNT</td><td>329</td></tr>'
                        tb+='<tr><td>Penerima BPUM</td><td>329</td></tr>'
                        tb+='<tr><td>Penerima BST</td><td>329</td></tr>'
                        tb+='<tr><td>Penerima PKH</td><td>329</td></tr>'
                        tb+='</table>'
                        //layer.bindPopup(feature.properties.Kecamatan);
                        layer.bindPopup(tb);
                    }
                }).addTo(map);
            });
    })


    function muncul(){
        $("#exampleModal").modal('show');

    }
</script>
