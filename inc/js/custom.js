    // Initialize all modules on page load
    $(document).ready(function(){
        // Audio module
        $('.audioModul').each(function(){
            var audio = $(this).data('audio');
            var audioId = 'audio_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-audio-id', audioId);
            
            var playerHtml = '<div class="audioPrikaz dn" id="' + audioId + '">' +
                '<h5>AUDIO CONSULTATION</h5>' +
                '<audio controls style="width: 100%;">' +
                '<source src="https://coach.profesionalnaastrologija.com/upload/media/' + audio + '" type="audio/mpeg">' +
                'Your browser does not support the audio element.' +
                '</audio>' +
                '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(playerHtml);
        });
        
        // Frequency module
        $('.frekvencijaModul').each(function(){
            var freq = $(this).data('frekvencija');
            var freqId = 'freq_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-freq-id', freqId);
            
            var playerHtml = '<div class="frekvencijaPrikaz dn" id="' + freqId + '">' +
                '<h5>AUDIO FREQUENCY</h5>' +
                '<audio controls style="width: 100%;">' +
                '<source src="https://studiotrid.net/EA/' + freq + '" type="audio/mpeg">' +
                'Your browser does not support the audio element.' +
                '</audio>' +
                '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(playerHtml);
        });
        
        // Cart (Natal Chart) module
        $('.cartModul').each(function(){
            var cart = $(this).data('cart');
            var cartId = 'cart_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-cart-id', cartId);
            
            var chartHtml = '<div class="cartPrikaz dn" id="' + cartId + '">' +
                '<h5>NATAL CHART</h5>' +
                '<img src="https://coach.profesionalnaastrologija.com/upload/chart/' + cart + '" alt="Natal Chart" style="width: 100%; max-width: 800px; height: auto; display: block; margin: 0 auto;">' +
                '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(chartHtml);
        });

        // Inkarnacije (Previous/Next charts) module
        $('.inkarnacijeModul').each(function(){
            var prethodnaCart = $(this).attr('data-prethodna-cart');
            var prethodnaPol = $(this).attr('data-prethodna-pol');
            var narednaCart = $(this).attr('data-naredna-cart');
            var narednaPol = $(this).attr('data-naredna-pol');
            var inkId = 'inkarnacije_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-inkarnacije-id', inkId);

            var baseUrl = 'https://coach.profesionalnaastrologija.com/upload/chart/';

            function buildChartBlock(title, cart, pol){
                if((!cart || cart === '') && (!pol || pol === '')){
                    return '';
                }

                var imgHtml = '';
                if(cart && cart !== ''){
                    var imgSrc = baseUrl + cart;
                    var uniqueImgId = 'ink_img_' + Math.random().toString(36).substr(2, 9);
                    imgHtml = '<img src="' + imgSrc + '" alt="' + title + '" class="ink-chart-img" id="' + uniqueImgId + '" style="width:100%; max-width:520px; height:auto; display:block; margin:0 auto; cursor:zoom-in;">';
                }

                var polHtml = '';
                if(pol && pol !== ''){
                    polHtml = '<div style="margin-top:8px; font-weight:600;">Pol: ' + pol + '</div>';
                }

                return '<div style="flex:1 1 0; min-width:260px; text-align:center;">' +
                    '<h5 style="margin:0 0 10px 0;">' + title + '</h5>' +
                    imgHtml +
                    polHtml +
                    '</div>';
            }

            var prevBlock = buildChartBlock('Prethodna inkarnacija', prethodnaCart, prethodnaPol);
            var nextBlock = buildChartBlock('Naredna inkarnacija', narednaCart, narednaPol);

            var inkHtml = '<div class="inkarnacijePrikaz dn" id="' + inkId + '">' +
                '<div style="display:flex; flex-wrap:wrap; gap:20px; align-items:flex-start; justify-content:space-between;">' +
                prevBlock + nextBlock +
                '</div>' +
                '</div>';

            $(this).closest('.ui-accordion-content, .modulHolder').append(inkHtml);

            // Attach click handler to images after they're added to the DOM
            $(document).on('click', '.ink-chart-img', function(){
                var imageSrc = $(this).attr('src');
                var imageAlt = $(this).attr('alt');
                var modalId = 'ink_modal_' + Math.random().toString(36).substr(2, 9);

                var modalContent = '<div id="' + modalId + '" style="background:#ffffff; text-align:center; padding:10px;">' +
                    '<img src="' + imageSrc + '" alt="' + imageAlt + '" style="width:100%; max-width:90%; height:auto; display:block; margin:0 auto;">' +
                    '</div>';

                $(modalContent).dialog({
                    modal: true,
                    width: $(window).width() > 1000 ? 900 : '95%',
                    maxHeight: $(window).height() * 0.9,
                    title: imageAlt,
                    dialogClass: 'ink-dialog',
                    close: function(){
                        $(this).dialog('destroy').remove();
                    }
                });
            });
        });
        
        // Video module (Vimeo - videoModulEA)
        $('.videoModulEA').each(function(){
            var vimeo = $(this).data('vimeo');
            var videoId = 'video_ea_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-video-id', videoId);
            
            var videoHtml = '<div class="videoPrikaz dn" id="' + videoId + '">' +
                '<div style="padding:73.17% 0 0 0;position:relative;">' +
                '<iframe src="https://player.vimeo.com/video/' + vimeo + '?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&app_id=58479" ' +
                'frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share" ' +
                'referrerpolicy="strict-origin-when-cross-origin" style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>' +
                '</div></div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(videoHtml);
        });
        
        // Video module (Vimeo - videoModulMT)
        $('.videoModulMT').each(function(){
            var vimeo = $(this).data('vimeo');
            var videoId = 'video_mt_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-video-id', videoId);
            
            var videoHtml = '<div class="videoPrikaz dn" id="' + videoId + '">' +
                '<div style="padding:73.17% 0 0 0;position:relative;">' +
                '<iframe src="https://player.vimeo.com/video/' + vimeo + '?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&app_id=58479" ' +
                'frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share" ' +
                'referrerpolicy="strict-origin-when-cross-origin" style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>' +
                '</div></div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(videoHtml);
        });
        
        // Video module (YouTube - videoModul)
        $('.videoModul').each(function(){
            var youtube = $(this).data('youtube');
            if(youtube){
                var videoId = 'video_yt_' + Math.random().toString(36).substr(2, 9);
                $(this).attr('data-video-id', videoId);
                
                var videoHtml = '<div class="videoPrikaz dn" id="' + videoId + '">' +
                    '<iframe width="100%" height="360" src="https://www.youtube.com/embed/' + youtube + '?rel=0&controls=0&showinfo=0" ' +
                    'frameborder="0" allowfullscreen></iframe>' +
                    '</div>';
                
                $(this).closest('.ui-accordion-content, .modulHolder').append(videoHtml);
            }
        });
        
        // Guided meditations module
        $('.vodjeneModul').each(function(){
            var vodjene = $(this).data('vodjene');
            var vodjeneId = 'vodjene_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-vodjene-id', vodjeneId);
            
            var vodjeneHtml = '<div class="vodjenePrikaz dn" id="' + vodjeneId + '">' +
                '<h5>GUIDED MEDITATIONS</h5><ul>';
            
            if(vodjene && Array.isArray(vodjene)){
                vodjene.forEach(function(item){
                    vodjeneHtml += '<p><strong>' + item.tekst + '</strong></p>' +
                        '<audio controls style="width: 100%;"><source src="/upload/media/' + item.url + '" type="audio/mpeg"></audio>';
                });
            }
            vodjeneHtml += '</ul></div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(vodjeneHtml);
        });
        
        // Venus chart module
        $('.venera_chartModul').each(function(){
            var charts = $(this).data('charts');
            var chartId = 'venera_chart_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-chart-id', chartId);
            
            var chartHtml = '<div class="venera_chartPrikaz dn" id="' + chartId + '">';
            
            if(charts && Array.isArray(charts)){
                charts.forEach(function(chart){
                    if(typeof chart === 'string'){
                        chartHtml += '<p><img src="https://coach.profesionalnaastrologija.com/upload/image/' + chart + '" ' +
                            'class="img-responsive" style="width:100%;height:auto"/></p>';
                    }
                });
            }
            chartHtml += '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(chartHtml);
        });
        
        // Affirmations module
        $('.afirmacijaModul').each(function(){
            var afirmId = $(this).data('afirmacija');
            var afirmacije = $(this).data('afirmacije');
            
            // Debug: log data to see structure
            console.log('Affirmations data:', afirmacije);
            
            var afirmHtml = '<div class="afirmacijaPrikaz dn" id="' + afirmId + '">' +
                '<h5>AFFIRMATIONS</h5>' +
                '<p>Choose one of ten offered affirmation for this energy center and practice it in the morning and evening, ' +
                'and at any time during the day when you feel you need it. First say it loud, and then visualize it and feeling it as if it had already happened.</p>';
            
            if(afirmacije){
                // If it's a string, try to parse it as JSON
                if(typeof afirmacije === 'string'){
                    try{
                        afirmacije = JSON.parse(afirmacije);
                    } catch(e){
                        console.error('Failed to parse afirmacije JSON:', e);
                    }
                }
                
                if(Array.isArray(afirmacije)){
                    // Group affirmations by center
                    var grouped = {};
                    afirmacije.forEach(function(item){
                        var centar = item.centar || 'Unknown';
                        if(!grouped[centar]){
                            grouped[centar] = [];
                        }
                        grouped[centar].push(item);
                    });
                    
                    // Display grouped affirmations
                    Object.keys(grouped).forEach(function(centar){
                        afirmHtml += '<h6 style="margin-top: 20px; color: #ce9a59;">' + centar + '. Energy center</h6>';
                        afirmHtml += '<ul>';
                        grouped[centar].forEach(function(item){
                            var tekst = item.pitanje || item.tekst || item.text || item.afirmacija || '';
                            if(tekst){
                                afirmHtml += '<li><strong>' + tekst + '</strong></li>';
                            }
                        });
                        afirmHtml += '</ul>';
                    });
                }
            }
            afirmHtml += '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(afirmHtml);
        });
        
        // Rituali module
        $('.ritualiModul').each(function(){
            var tekst = $(this).data('tekst');
            var ritualiId = 'rituali_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-rituali-id', ritualiId);
            
            var ritualiHtml = '<div class="ritualiPrikaz dn" id="' + ritualiId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<h5>Animal Guide Ritual</h5>' +
                '<div style="width: 100%;">' + tekst + '</div>' +
                '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(ritualiHtml);
        });
        
        // Meditacija module
        $('.meditacijaModul').each(function(){
            var naziv = $(this).data('naziv');
            var fajl = $(this).data('fajl');
            var meditacijaId = 'meditacija_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-meditacija-id', meditacijaId);
            
            var meditacijaHtml = '<div class="meditacijaPrikaz dn" id="' + meditacijaId + '" style="padding: 15px; background: rgba(15, 36, 65, 0.6); border-radius: 5px; width: 100%;">' +
                '<h5>' + naziv + '</h5>' +
                '<audio controls style="width: 100%; margin-top: 10px;">' +
                '<source src="' + fajl + '" type="audio/mpeg">' +
                'Your browser does not support the audio element.' +
                '</audio>' +
                '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(meditacijaHtml);
        });
        
        // Zmaj (Dragon) module
        $('.zmajModul').each(function(){
            var ime = $(this).data('ime');
            var slika = $(this).data('slika');
            var priroda = $(this).data('priroda');
            var zmajId = 'zmaj_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-zmaj-id', zmajId);
            
            var zmajHtml = '<div class="zmajPrikaz dn" id="' + zmajId + '" style="padding: 15px; background: rgba(15, 36, 65, 0.6); border-radius: 5px; width: 100%;">' +
                '<h5>Dragon: ' + ime + '</h5>';
            
            if(slika && slika !== ''){
                zmajHtml += '<div style="text-align: center; margin: 15px 0;">' +
                    '<img src="/upload/image/' + slika + '" alt="' + ime + '" style="max-width: 100%; height: auto; border-radius: 5px;">' +
                    '</div>';
            }
            
            zmajHtml += '<p><strong>Planetary nature of the Dragon:</strong> ' + priroda + '</p>' +
                '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(zmajHtml);
        });
        
        // Vezbe (Exercises) module
        $('.vezbeModul').each(function(){
            var tekst = $(this).data('tekst');
            var vezbeId = 'vezbe_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-vezbe-id', vezbeId);
            
            var vezbeHtml = '<div class="vezbePrikaz dn" id="' + vezbeId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<h5>Physical Exercises:</h5>' +
                '<div style="width: 100%; line-height: 1.6;">' + tekst + '</div>' +
                '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(vezbeHtml);
        });
        
        // Vodic (Spiritual Guide) module
        $('.vodicModul').each(function(){
            var zivotinja = $(this).data('zivotinja');
            var priroda = $(this).data('priroda');
            var ritual = $(this).data('ritual');
            var prikaziRitual = $(this).data('prikazi-ritual');
            var label = $(this).data('label');
            var vodicId = 'vodic_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-vodic-id', vodicId);
            
            var vodicHtml = '<div class="vodicPrikaz dn" id="' + vodicId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<p><strong>' + label + ':</strong> ' + zivotinja + '</p>' +
                '<p><strong>Planetary nature of ' + label + ':</strong> ' + priroda + '</p>';
            
            if(prikaziRitual == 1 && ritual && ritual !== ''){
                vodicHtml += '<div style="margin-top: 15px;"><strong>Ritual:</strong></div>' +
                    '<div style="margin-top: 10px; line-height: 1.6;">' + ritual + '</div>';
            }
            
            vodicHtml += '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(vodicHtml);
        });

        // Senka module
        $('.senkaModul').each(function(){
            var faza = parseInt($(this).data('faza'), 10) || 0;
            var naslov = $(this).data('naslov') || '';
            var zivotinja = $(this).data('zivotinja') || '';
            var ritual = $(this).data('ritual') || '';
            var prikaziRitual = $(this).data('prikazi-ritual');
            var senkaId = 'senka_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-senka-id', senkaId);

            var senkaHtml = '<div class="senkaPrikaz dn" id="' + senkaId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<p><strong>' + naslov + ':</strong> ' + zivotinja + '</p>';

            if(faza === 1){
                if(ritual && ritual !== ''){
                    senkaHtml += '<div style="margin-top: 12px; line-height: 1.6;">' + ritual + '</div>';
                }
            } else if((faza === 2 || faza === 3 || faza === 4) && prikaziRitual == 1 && ritual && ritual !== ''){
                senkaHtml += '<div style="margin-top: 15px;"><strong>Ritual:</strong></div>' +
                    '<div style="margin-top: 10px; line-height: 1.6;">' + ritual + '</div>';
            }

            senkaHtml += '</div>';

            $(this).closest('.ui-accordion-content, .modulHolder').append(senkaHtml);
        });

        // Meditacija tekst module
        $('.meditacijaTekstModul').each(function(){
            var tekst = $(this).data('tekst');
            var meditacijaTekstId = 'meditacija_tekst_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-meditacija-tekst-id', meditacijaTekstId);

            var meditacijaTekstHtml = '<div class="meditacijaTekstPrikaz dn" id="' + meditacijaTekstId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<h5>Meditacija:</h5>' +
                '<div style="width: 100%; line-height: 1.6;">' + tekst + '</div>' +
                '</div>';

            $(this).closest('.ui-accordion-content, .modulHolder').append(meditacijaTekstHtml);
        });
        
        // Vodjena (Guided Meditation) module
        $('.vodjenaModul').each(function(){
            var naziv = $(this).data('naziv');
            var vodjenaId = 'vodjena_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-vodjena-id', vodjenaId);
            
            var vodjenaHtml = '<div class="vodjenaPrikaz dn" id="' + vodjenaId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<p><strong>Guided meditation:</strong> ' + naziv + '</p>' +
                '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(vodjenaHtml);
        });
        
        // Kamen (Stone Meditation) module
        $('.kamenModul').each(function(){
            var tekst = $(this).data('tekst');
            var kamenId = 'kamen_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-kamen-id', kamenId);
            
            var kamenHtml = '<div class="kamenPrikaz dn" id="' + kamenId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<h5>Stone Meditation:</h5>' +
                '<div style="width: 100%; line-height: 1.6;">' + tekst + '</div>' +
                '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(kamenHtml);
        });
        
        // Andjeo (Angel) module
        $('.andjeoModul').each(function(){
            var andjeo = $(this).data('andjeo');
            var kamen = $(this).data('kamen');
            var priroda = $(this).data('priroda');
            var label = $(this).data('label');
            var labelShort = $(this).data('label-short');
            var andjeoId = 'andjeo_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-andjeo-id', andjeoId);
            
            var andjeoHtml = '<div class="andjeoPrikaz dn" id="' + andjeoId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<p><strong>' + label + ':</strong> ' + andjeo + '</p>';
            
            if(kamen && kamen !== ''){
                andjeoHtml += '<p><strong>Gem Stone:</strong> ' + kamen + '</p>';
            }
            
            andjeoHtml += '<p><strong>Planetary nature of ' + labelShort + ':</strong> ' + priroda + '</p>' +
                '</div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(andjeoHtml);
        });

        // Karmicko uverenje zivot module
        $('.karmickoUverenjeZivotModul').each(function(){
            var negativnoUverenje = $(this).data('negativno-uverenje') || '';
            var zivotBroj = $(this).data('zivot-broj') || '';
            var pol = $(this).data('pol') || '';
            var najkvalitetnijeUverenje = $(this).data('najkvalitetnije-uverenje') || '';
            var andjeo = $(this).data('andjeo') || '';
            var karmickoUverenjeId = 'karmicko_uverenje_zivot_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-karmicko-uverenje-zivot-id', karmickoUverenjeId);

            var karmickoUverenjeHtml = '<div class="karmickoUverenjeZivotPrikaz dn" id="' + karmickoUverenjeId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%; line-height: 1.8;">' +
                '<p>Život u kome je stečeno negativno karmičko uverenje koje glasi: <strong>' + negativnoUverenje + '</strong> jeste <strong>' + zivotBroj + '</strong> prethodni život. Osoba je u tom životu rođena kao <strong>' + pol + '</strong>.</p>' +
                '<p>Najkvalitetnije uverenje za <strong>' + zivotBroj + '</strong> prethodni život glasi: <strong>' + najkvalitetnijeUverenje + '</strong></p>' +
                '<p>Anđeo kojim se sada uspostavlja veza sa svojim <strong>' + zivotBroj + '</strong> prethodnim životom je <strong>' + andjeo + '</strong>.</p>' +
                '</div>';

            $(this).closest('.ui-accordion-content, .modulHolder').append(karmickoUverenjeHtml);
        });

        // Andjeo veza sa prethodnim zivotom (module 105)
        $('.andjeoFaza2VezaModul').each(function(){
            var zivotBroj = $(this).data('broj') || '';
            var andjeo = $(this).data('andjeo') || '';
            var andjeoF2Id = 'andjeo_faza2_veza_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-andjeo-faza2-veza-id', andjeoF2Id);

            var andjeoF2Html = '<div class="andjeoFaza2VezaPrikaz dn" id="' + andjeoF2Id + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%; line-height: 1.8;">' +
                '<p>Anđeo kojim se sada uspostavlja veza sa svojim <strong>' + zivotBroj + '.</strong> prethodnim životom je <strong>' + andjeo + '</strong>.</p>' +
                '</div>';

            $(this).closest('.ui-accordion-content, .modulHolder').append(andjeoF2Html);
        });
        
        // Termini (Karmic Test Schedule) module
        $('.terminiModul').each(function(){
            var terminiData = $(this).data('termini');
            var terminiId = 'termini_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-termini-id', terminiId);
            
            var terminiHtml = '<div class="terminiPrikaz dn" id="' + terminiId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<h5>Karmic Test Schedule</h5>' +
                '<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">' +
                '<thead>' +
                '<tr style="background: rgba(0, 0, 0, 0.3);">' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Date</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Time</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Center</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Intensity</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Success</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
            
            if(terminiData && Array.isArray(terminiData)){
                terminiData.forEach(function(termin){
                    var uspehText = '';
                    if(termin.uspehText) {
                        uspehText = '<span style="color: #e2c197;">' + termin.uspehText + '</span>';
                    }
                    terminiHtml += '<tr>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.datum || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.vreme || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.planeta || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.intenzitet || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);" class="termini-uspeh" data-id="' + (termin.ID || '') + '">' + uspehText + '</td>' +
                        '</tr>';
                });
            }
            
            terminiHtml += '</tbody></table></div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(terminiHtml);
        });
        
        // Aktiviranje (Karmic Activation Schedule) module
        $('.aktiviranjeModul').each(function(){
            var aktiviranjeData = $(this).data('aktiviranje');
            var aktiviranjeId = 'aktiviranje_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-aktiviranje-id', aktiviranjeId);
            
            var aktiviranjeHtml = '<div class="aktiviranjePrikaz dn" id="' + aktiviranjeId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<h5>Karmic Activation Schedule</h5>' +
                '<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">' +
                '<thead>' +
                '<tr style="background: rgba(0, 0, 0, 0.3);">' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Date</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Time</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Center</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Intensity</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Success</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
            
            if(aktiviranjeData && Array.isArray(aktiviranjeData)){
                aktiviranjeData.forEach(function(termin){
                    var uspehText = '';
                    if(termin.uspehText) {
                        uspehText = '<span style="color: #e2c197;">' + termin.uspehText + '</span>';
                    }
                    aktiviranjeHtml += '<tr>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.datum || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.vreme || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.planeta || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.intenzitet || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);" class="aktiviranje-uspeh" data-id="' + (termin.ID || '') + '">' + uspehText + '</td>' +
                        '</tr>';
                });
            }
            
            aktiviranjeHtml += '</tbody></table></div>';
            
            $(this).closest('.ui-accordion-content, .modulHolder').append(aktiviranjeHtml);
        });

        // Aktiviranje karmickih vertikala module
        $('.aktiviranjeKarmickeVertikaleModul').each(function(){
            var karmickeVertikaleData = $(this).data('karmicke-vertikale');
            var karmickeVertikaleNaslov = $(this).data('karmicke-vertikale-naslov') || 'Karmicke Vertikale';
            var karmickeVertikaleId = 'karmicke_vertikale_' + Math.random().toString(36).substr(2, 9);
            $(this).attr('data-karmicke-vertikale-id', karmickeVertikaleId);

            var karmickeVertikaleHtml = '<div class="karmickeVertikalePrikaz dn" id="' + karmickeVertikaleId + '" style="padding: 15px; border-radius: 5px; background: rgba(15, 36, 65, 0.6); width: 100%;">' +
                '<h5>' + karmickeVertikaleNaslov + '</h5>' +
                '<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">' +
                '<thead>' +
                '<tr style="background: rgba(0, 0, 0, 0.3);">' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Date</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Time</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Chakra</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Intensity</th>' +
                '<th style="padding: 8px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.2);">Success</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

            if(karmickeVertikaleData && Array.isArray(karmickeVertikaleData)){
                karmickeVertikaleData.forEach(function(termin){
                    var uspehText = '';
                    if(termin.uspehText) {
                        uspehText = '<span style="color: #e2c197;">' + termin.uspehText + '</span>';
                    }
                    karmickeVertikaleHtml += '<tr>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.datumLocale || termin.datum || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.vreme || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.planeta || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);">' + (termin.intenzitet || '') + '</td>' +
                        '<td style="padding: 8px; border: 1px solid rgba(255, 255, 255, 0.2);" class="karmicke-vertikale-uspeh" data-id="' + (termin.ID || termin.id || '') + '">' + uspehText + '</td>' +
                        '</tr>';
                });
            }

            karmickeVertikaleHtml += '</tbody></table></div>';

            $(this).closest('.ui-accordion-content, .modulHolder').append(karmickeVertikaleHtml);
        });
        
        // Iskustvo (Experience) module - already full width, just ensure event handlers work
        $('.iskustvoModul').each(function(){
            var $module = $(this);
            var konsultacijaId = $module.data('konsultacija');
            
            $module.find('.saveIskustvo').on('click', function(){
                var $btn = $(this);
                var $textarea = $module.find('.iskustvoContent');
                var $status = $module.find('.iskustvoStatus');
                var content = $textarea.val();
                
                $.ajax({
                    url: '/inc/ajax/save_iskustvo.php',
                    method: 'POST',
                    data: {
                        konsultacija_id: konsultacijaId,
                        iskustvo: content
                    },
                    success: function(response){
                        $status.fadeIn().delay(2000).fadeOut();
                    },
                    error: function(){
                        alert('Error saving experience');
                    }
                });
            });
        });
        
        // Cards module - keep existing inline functionality
        
        // Load Vimeo player script if needed
        if($('.videoModulEA, .videoModulMT').length > 0){
            if(!$('script[src*="vimeo.com"]').length){
                $('body').append('<script src="https://player.vimeo.com/api/player.js"><\/script>');
            }
        }
    });
    
    // Helper function for consistent smooth scroll to content
    function scrollToContent(contentElement) {
        if (!contentElement || contentElement.length === 0) return;
        
        // Determine responsive offset based on screen size
        var scrollOffset = $(window).width() < 768 ? 10 : 30;
        
        // Get header height if fixed (to account for sticky headers)
        var headerHeight = $('header').outerHeight() || 0;
        var totalOffset = headerHeight + scrollOffset;
        
        $('html, body').animate({
            scrollTop: contentElement.offset().top - totalOffset
        }, 500);
    }
    
    // Click handlers for all modules
    $('.audioModul').on('click',function(e){ 
        var audioId = $(this).attr('data-audio-id');
        $('#' + audioId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + audioId).hasClass('dn')){
            scrollToContent($('#' + audioId));
        }
    });
    
    $('.frekvencijaModul').on('click',function(e){ 
        var freqId = $(this).attr('data-freq-id');
        $('#' + freqId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + freqId).hasClass('dn')){
            scrollToContent($('#' + freqId));
        }
    });
    
    $('.cartModul').on('click',function(e){ 
        var cartId = $(this).attr('data-cart-id');
        $('#' + cartId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + cartId).hasClass('dn')){
            scrollToContent($('#' + cartId));
        }
    });

    $('.inkarnacijeModul').on('click',function(e){ 
        var inkId = $(this).attr('data-inkarnacije-id');
        $('#' + inkId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + inkId).hasClass('dn')){
            scrollToContent($('#' + inkId));
        }
    });

    $('.box').on('click',function(e){ 
        var tip = $(this).data('tip');
        document.location.href = '/type/' + tip + '/'; 
    });
    
    $('.afirmacijaModul').on('click', function(){
        var afirmacija = $(this).data('afirmacija');
        $('#' + afirmacija).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + afirmacija).hasClass('dn')){
                scrollToContent($('#' + afirmacija));
        }
    });
    
    $('.videoModul').on('click', function(){
        var videoId = $(this).attr('data-video-id');
        $('#' + videoId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + videoId).hasClass('dn')){
                scrollToContent($('#' + videoId));
        }
    });
        
    $('.videoModulEA').on('click', function(){
        var videoId = $(this).attr('data-video-id');
        $('#' + videoId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + videoId).hasClass('dn')){
                 scrollToContent($('#' + videoId));
        }
    });
        
    $('.videoModulMT').on('click', function(){
        var videoId = $(this).attr('data-video-id');
        $('#' + videoId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + videoId).hasClass('dn')){
                 scrollToContent($('#' + videoId));
        }
    });
    
    $('.vodjeneModul').on('click', function(){
        var vodjeneId = $(this).attr('data-vodjene-id');
        $('#' + vodjeneId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + vodjeneId).hasClass('dn')){
                scrollToContent($('#' + vodjeneId));
        }
    });
    
    $('.venera_chartModul').on('click', function(){
        var chartId = $(this).attr('data-chart-id');
        $('#' + chartId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + chartId).hasClass('dn')){
                scrollToContent($('#' + chartId));
        }
    });
    
    $('.ritualiModul').on('click', function(){
        var ritualiId = $(this).attr('data-rituali-id');
        $('#' + ritualiId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + ritualiId).hasClass('dn')){
                scrollToContent($('#' + ritualiId));
        }
    });
    
    $('.meditacijaModul').on('click', function(){
        var meditacijaId = $(this).attr('data-meditacija-id');
        $('#' + meditacijaId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + meditacijaId).hasClass('dn')){
                scrollToContent($('#' + meditacijaId));
        }
    });
    
    $('.zmajModul').on('click', function(){
        var zmajId = $(this).attr('data-zmaj-id');
        $('#' + zmajId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + zmajId).hasClass('dn')){
                scrollToContent($('#' + zmajId));
        }
    });
    
    $('.vezbeModul').on('click', function(){
        var vezbeId = $(this).attr('data-vezbe-id');
        $('#' + vezbeId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + vezbeId).hasClass('dn')){
                scrollToContent($('#' + vezbeId));
        }
    });
    
    $('.vodicModul').on('click', function(){
        var vodicId = $(this).attr('data-vodic-id');
        $('#' + vodicId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + vodicId).hasClass('dn')){
                scrollToContent($('#' + vodicId));
        }
    });

    $('.senkaModul').on('click', function(){
        var senkaId = $(this).attr('data-senka-id');
        $('#' + senkaId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + senkaId).hasClass('dn')){
                scrollToContent($('#' + senkaId));
        }
    });

    $('.meditacijaTekstModul').on('click', function(){
        var meditacijaTekstId = $(this).attr('data-meditacija-tekst-id');
        $('#' + meditacijaTekstId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + meditacijaTekstId).hasClass('dn')){
                scrollToContent($('#' + meditacijaTekstId));
        }
    });
    
    $('.vodjenaModul').on('click', function(){
        var vodjenaId = $(this).attr('data-vodjena-id');
        $('#' + vodjenaId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + vodjenaId).hasClass('dn')){
                scrollToContent($('#' + vodjenaId));
        }
    });
    
    $('.kamenModul').on('click', function(){
        var kamenId = $(this).attr('data-kamen-id');
        $('#' + kamenId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + kamenId).hasClass('dn')){
                scrollToContent($('#' + kamenId));
        }
    });
    
    $('.andjeoModul').on('click', function(){
        var andjeoId = $(this).attr('data-andjeo-id');
        $('#' + andjeoId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + andjeoId).hasClass('dn')){
                scrollToContent($('#' + andjeoId));
        }
    });

    $('.karmickoUverenjeZivotModul').on('click', function(){
        var karmickoUverenjeId = $(this).attr('data-karmicko-uverenje-zivot-id');
        $('#' + karmickoUverenjeId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + karmickoUverenjeId).hasClass('dn')){
                scrollToContent($('#' + karmickoUverenjeId));
        }
    });

    $('.andjeoFaza2VezaModul').on('click', function(){
        var andjeoF2Id = $(this).attr('data-andjeo-faza2-veza-id');
        $('#' + andjeoF2Id).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + andjeoF2Id).hasClass('dn')){
                scrollToContent($('#' + andjeoF2Id));
        }
    });
    
    $('.terminiModul').on('click', function(){
        var terminiId = $(this).attr('data-termini-id');
        $('#' + terminiId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + terminiId).hasClass('dn')){
                scrollToContent($('#' + terminiId));
        }
    });
    
    $('.aktiviranjeModul').on('click', function(){
        var aktiviranjeId = $(this).attr('data-aktiviranje-id');
        $('#' + aktiviranjeId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + aktiviranjeId).hasClass('dn')){
                scrollToContent($('#' + aktiviranjeId));
        }
    });

    $('.aktiviranjeKarmickeVertikaleModul').on('click', function(){
        var karmickeVertikaleId = $(this).attr('data-karmicke-vertikale-id');
        $('#' + karmickeVertikaleId).toggleClass('dn');
        $(this).toggleClass('active');
        if(!$('#' + karmickeVertikaleId).hasClass('dn')){
                scrollToContent($('#' + karmickeVertikaleId));
        }
    });
    
    // Cards module - Create modal if not exists
    if ($('#cards-modal-global').length === 0) {
        var modalHtml = '<div id="cards-modal-global" class="card-modal" style="display:none;">' +
            '<div class="card-modal-overlay"></div>' +
            '<div class="card-modal-content">' +
            '<span class="card-modal-close">&times;</span>' +
            '<img src="" alt="Karta" class="card-modal-image">' +
            '<div class="card-modal-date"></div>' +
            '</div>' +
            '</div>';
        $('body').append(modalHtml);
    }
    
    // Cards module click handler
    $('.modul-icon[data-module="cards"]').on('click', function() {
        $(this).toggleClass('active');
        var consultationId = $(this).data('consultation');
        var content = $('#cards-content-' + consultationId);
        
        if(content.is(':visible')) {
            content.slideUp();
        } else {
            content.slideDown(400, function() {
                // After content is visible, scroll to it
                $('html, body').animate({
                    scrollTop: content.offset().top - 100
                }, 500);
                
                // Start flipping animations for unopened cards
                content.find('.card-image.flipping').each(function() {
                    var cardId = $(this).data('card-id');
                    var img = $(this);
                    
                    // Show the spinning animation
                    img.attr('src', '/img/karte/vrti.gif?t=' + new Date().getTime());
                    img.removeClass('unopened');
                    
                    // Wait for animation then load actual card
                    setTimeout(function() {
                        $.ajax({
                            url: '/inc/ajax/draw_card.php',
                            method: 'POST',
                            data: { card_id: cardId },
                            dataType: 'json',
                            success: function(response) {
                                if(response.success && response.card_number) {
                                    img.attr('src', '/img/karte/' + response.card_number + '.jpg');
                                    img.removeClass('flipping').addClass('revealed clickable-card');
                                    img.attr('data-card-number', response.card_number);
                                    
                                    var cardDate = img.closest('.card-item').data('date');
                                    img.attr('data-card-date', cardDate);
                                    
                                    // If today's card, add experience section
                                    if(response.is_today) {
                                        var dateFormatted = cardDate;
                                        var experienceHtml = '<div class="today-experience-section">' +
                                            '<h3 class="experience-title">Vaše iskustvo za danas - ' + dateFormatted + '</h3>' +
                                            '<textarea class="card-experience-input today-experience" data-card-id="' + cardId + '" ' +
                                            'placeholder="Unesite vaše iskustvo za danas..." rows="5"></textarea>' +
                                            '<button class="save-experience-btn" data-card-id="' + cardId + '">Sačuvaj iskustvo</button>' +
                                            '</div>';
                                        
                                        if(content.find('.today-experience-section').length === 0) {
                                            content.prepend(experienceHtml);
                                        }
                                    }
                                }
                            },
                            error: function() {
                                img.attr('src', '/img/karte/0.jpg');
                                console.error('Error drawing card');
                            }
                        });
                    }, 3500); // Wait 3.5 seconds for gif animation
                });
            });
        }
    });
    
    // Click on card to enlarge
    $(document).on('click', '.clickable-card', function() {
        var cardNumber = $(this).data('card-number');
        var cardDate = $(this).data('card-date');
        var imgSrc = '/img/karte/' + cardNumber + '.jpg';
        
        $('#cards-modal-global .card-modal-image').attr('src', imgSrc);
        $('#cards-modal-global .card-modal-date').text(cardDate);
        $('#cards-modal-global').fadeIn(300);
    });
    
    // Close modal
    $(document).on('click', '.card-modal-close, .card-modal-overlay', function() {
        $('#cards-modal-global').fadeOut(300);
    });
    
    // Close modal on Esc key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            $('#cards-modal-global').fadeOut(300);
        }
    });
    
    // Save experience
    $(document).on('click', '.save-experience-btn', function() {
        var btn = $(this);
        var cardId = btn.data('card-id');
        var textarea = $('.card-experience-input[data-card-id="' + cardId + '"]');
        var experience = textarea.val();
        
        btn.prop('disabled', true).text('Čuvanje...');
        
        $.ajax({
            url: '/inc/ajax/save_card_experience.php',
            method: 'POST',
            data: { 
                card_id: cardId,
                experience: experience
            },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    btn.text('Sačuvano!');
                    setTimeout(function() {
                        btn.prop('disabled', false).text('Sačuvaj iskustvo');
                    }, 2000);
                } else {
                    alert('Greška pri čuvanju iskustva');
                    btn.prop('disabled', false).text('Sačuvaj iskustvo');
                }
            },
            error: function() {
                alert('Greška pri čuvanju iskustva');
                btn.prop('disabled', false).text('Sačuvaj iskustvo');
            }
        });
    });

    // =========================================================
    // KOSMICKA PORUKA MODULE
    // =========================================================

    // Render golden line on page load for all visible Kosmicka modules
    $(function() {
        $('.kosmicka-poruka-content').each(function() {
            var $content = $(this);
            var isFaza2 = parseInt($content.find('.kosmicka-grid-wrapper').data('is-faza-2'), 10) === 1;
            if (!isFaza2) {
                renderKarmickaVertikala($content);
            }

            // Scroll to today's card so it is always visible (useful on mobile)
            var today = $content.find('.kosmicka-grid-wrapper').data('today');
            if (!today) return;
            var $todaySlot = $content.find('.kosmicka-card-slot[data-datum="' + today + '"]');
            if (!$todaySlot.length) return;
            var slotLeft      = $todaySlot.offset().left - $content.offset().left + $content.scrollLeft();
            var scrollTo      = slotLeft - ($content.outerWidth() / 2) + ($todaySlot.outerWidth() / 2);
            $content.scrollLeft(Math.max(0, scrollTo));
        });
    });

    // --- Physical mode: select constellation from dropdown ---
    $(document).on('change', '.kosmicka-select', function() {
        var $sel      = $(this);
        var karta     = parseInt($sel.val());
        if (!karta) return;
        var datum     = $sel.data('datum');
        var konsult   = $sel.data('konsultacija');
        var idx       = $sel.data('idx');
        var isFaza2   = parseInt($sel.closest('.kosmicka-grid-wrapper').data('is-faza-2'), 10) === 1;

        $.ajax({
            url: '/inc/ajax/save_kosmicka_karta.php',
            type: 'POST',
            data: { konsultacija: konsult, datum: datum, karta: karta },
            dataType: 'json',
            success: function(resp) {
                if (resp.success) {
                    var $slot = $sel.closest('.kosmicka-card-slot');
                    $slot.find('.kosmicka-card-name').text(resp.naziv);
                    $slot.find('.kosmicka-card-img').attr('src', resp.img_path)
                        .addClass('clickable-kosmicka')
                        .data('img', resp.img_path)
                        .data('naziv', resp.naziv);
                    $slot.find('.kosmicka-num').removeClass('kosmicka-num-center').addClass('kosmicka-num-drawn');
                    $sel.hide();
                    if (!isFaza2) {
                        openKosmickaScoreDialog(konsult, datum, idx);
                    }
                }
            }
        });
    });

    // --- Digital mode: click to draw ---
    $(document).on('click', '.kosmicka-draw-digital', function() {
        var $wrap   = $(this);
        if ($wrap.data('drawing')) return;
        $wrap.data('drawing', true);
        var datum   = $wrap.data('datum');
        var konsult = $wrap.data('konsultacija');
        var idx     = $wrap.data('idx');
        var backImg = $wrap.data('back-img') || '/img/konstelacija/0.jpg';
        var isFaza2 = parseInt($wrap.closest('.kosmicka-grid-wrapper').data('is-faza-2'), 10) === 1;
        var shuffleTimer = null;

        // Show shuffle animation: phase 2 cycles goddess cards, other phases keep existing gif.
        if (isFaza2) {
            shuffleTimer = setInterval(function() {
                var shuffleCard = Math.floor(Math.random() * 72) + 1;
                $wrap.find('.kosmicka-card-img').attr('src', '/img/boginje/' + shuffleCard + '.jpg');
            }, 120);
        } else {
            $wrap.find('.kosmicka-card-img').attr('src', '/img/karte/vrti.gif');
        }

        setTimeout(function() {
            $.ajax({
                url: '/inc/ajax/draw_kosmicka_karta.php',
                type: 'POST',
                data: { konsultacija: konsult, datum: datum },
                dataType: 'json',
                success: function(resp) {
                    if (shuffleTimer) {
                        clearInterval(shuffleTimer);
                        shuffleTimer = null;
                    }
                    if (resp.success) {
                        var $slot = $wrap.closest('.kosmicka-card-slot');
                        $slot.find('.kosmicka-card-name').text(resp.naziv);
                        $wrap.find('.kosmicka-card-img')
                            .attr('src', resp.img_path)
                            .addClass('clickable-kosmicka')
                            .data('img', resp.img_path)
                            .data('naziv', resp.naziv);
                        $wrap.find('.kosmicka-num').removeClass('kosmicka-num-center').addClass('kosmicka-num-drawn');
                        $wrap.removeClass('kosmicka-draw-digital');
                        if (!isFaza2) {
                            openKosmickaScoreDialog(konsult, datum, idx);
                        }
                    } else {
                        $wrap.find('.kosmicka-card-img').attr('src', backImg);
                        $wrap.data('drawing', false);
                    }
                },
                error: function() {
                    if (shuffleTimer) {
                        clearInterval(shuffleTimer);
                        shuffleTimer = null;
                    }
                    $wrap.find('.kosmicka-card-img').attr('src', backImg);
                    $wrap.data('drawing', false);
                }
            });
        }, 3500);
    });

    // --- Enlarge card on click ---
    $(document).on('click', '.clickable-kosmicka', function() {
        var imgSrc = $(this).data('img') || $(this).attr('src');
        var naziv  = $(this).data('naziv') || '';
        if (!$('#kosmicka-img-modal').length) {
            $('body').append('<div id="kosmicka-img-modal" style="display:none;"><img id="kosmicka-img-modal-img" src="" alt="" style="max-width:100%;max-height:80vh;" /></div>');
        }
        $('#kosmicka-img-modal-img').attr('src', imgSrc).attr('alt', naziv);
        $('#kosmicka-img-modal').dialog({
            modal: true,
            width: 'auto',
            title: naziv,
            buttons: { 'Zatvori': function() { $(this).dialog('close'); } }
        });
    });

    // --- Score dialog helper ---
    function openKosmickaScoreDialog(konsult, datum, idx) {
        if (!$('#kosmicka-score-dialog').length) {
            return;
        }

        $('#kp-q1, #kp-q2, #kp-q3').val(5);
        $('.kp-range-val').text(5);
        $('#kp-komentar').val('');

        // Live update of range value display
        $('#kosmicka-score-dialog .kp-score-range').off('input.kp').on('input.kp', function() {
            $(this).siblings('.kp-range-val').text($(this).val());
        });

        $('#kp-score-submit').off('click.kp').on('click.kp', function() {
            var q1 = parseInt($('#kp-q1').val());
            var q2 = parseInt($('#kp-q2').val());
            var q3 = parseInt($('#kp-q3').val());
            var komentar = $('#kp-komentar').val();
            var $btn = $(this);
            $btn.prop('disabled', true).text('Čuvanje...');
            $.ajax({
                url: '/inc/ajax/save_kosmicka_scores.php',
                type: 'POST',
                data: { konsultacija: konsult, datum: datum, q1: q1, q2: q2, q3: q3, komentar: komentar },
                dataType: 'json',
                success: function(resp) {
                    if (resp.success) {
                        // Update procenat display below the card
                        $('.kosmicka-card-procenat[data-idx="' + idx + '"]').text(resp.procenat + '%').addClass('kp-has-val');
                        // Update row average if the row is now complete
                        if (resp.row_average !== null) {
                            var $slot    = $('.kosmicka-card-slot[data-idx="' + idx + '"]');
                            var $row     = $slot.closest('.kosmicka-cards-row');
                            var rGlobal  = $row.data('row');
                            $('.kosmicka-row-avg[data-row="' + rGlobal + '"]').text(resp.row_average + '%');
                            // Re-render golden line now that we have new data
                            var $content = $slot.closest('.kosmicka-poruka-content');
                            renderKarmickaVertikala($content);
                        }
                        $('#kosmicka-score-dialog').dialog('close');
                    } else {
                        alert((resp && resp.error) ? resp.error : 'Greška prilikom čuvanja testa.');
                    }
                },
                error: function() {
                    alert('Greška prilikom čuvanja testa.');
                },
                complete: function() {
                    $btn.prop('disabled', false).text('Sačuvaj');
                }
            });
        });

        $('#kosmicka-score-dialog').dialog({
            modal: true,
            width: 500,
            title: 'Ocena dana',
            dialogClass: 'kosmicka-score-dialog',
            buttons: {}
        });
    }

    // --- Karmicka Vertikala golden line renderer ---
    function renderKarmickaVertikala($content) {
        var $grid    = $content.find('.kosmicka-grid-wrapper');
        var isFaza2  = parseInt($grid.data('is-faza-2'), 10) === 1;
        if (isFaza2) return;
        var kolona   = parseInt($grid.data('kolona'));
        var bottomUp = parseInt($grid.data('bottom-up')) === 1;

        // Remove existing line elements
        $content.find('.kosmicka-vertikala-line').remove();
        $grid.css('position', 'relative');

        if (isNaN(kolona)) return;

        var $rows = $content.find('.kosmicka-cards-row');
        if ($rows.length === 0) return;

        var gridOffset = $grid.offset();
        var segments   = []; // collect completed-row data first

        $rows.each(function() {
            var $row    = $(this);
            var avgText = $row.find('.kosmicka-row-avg').text().replace('%', '').trim();
            var avg     = parseFloat(avgText);
            if (isNaN(avg)) return; // row not complete yet

            var $slot = $row.find('.kosmicka-card-slot').eq(kolona);
            if (!$slot.length) return;

            // Use the card image wrapper for bounds so we don't overlap date/name/procenat
            var $imgWrap = $slot.find('.kosmicka-card-img-wrap');
            var $target  = $imgWrap.length ? $imgWrap : $slot;
            var off      = $target.offset();
            var centerX  = $slot.offset().left - gridOffset.left + $slot.outerWidth() / 2;

            segments.push({
                top:     off.top - gridOffset.top,
                height:  $target.outerHeight(),
                bottom:  off.top - gridOffset.top + $target.outerHeight(),
                centerX: centerX,
                avg:     avg
            });
        });

        if (!segments.length) return;

        if (bottomUp) {
            segments.reverse();
        }

        var totalRows   = Math.ceil(parseInt($grid.data('ukupan-broj')) / 6);
        var allComplete = (segments.length === totalRows);

        // Draw segments. In bottom-up mode, each segment stretches upward to the next row.
        for (var i = 0; i < segments.length; i++) {
            var seg       = segments[i];
            var lineWidth = Math.max(1, seg.avg / 100 * 25);
            var top       = seg.top;
            var height    = seg.height;

            if (i < segments.length - 1) {
                if (bottomUp) {
                    top = segments[i + 1].top;
                    height = seg.bottom - top;
                } else {
                    height = segments[i + 1].top - seg.top;
                }
            }

            $('<div class="kosmicka-vertikala-line"></div>').css({
                position:      'absolute',
                top:           top + 'px',
                left:          (seg.centerX - lineWidth / 2) + 'px',
                width:         lineWidth + 'px',
                height:        height + 'px',
                background:    'linear-gradient(to bottom, #ffd700, #b8860b)',
                borderRadius:  (lineWidth / 2) + 'px',
                pointerEvents: 'none',
                zIndex:        4,
            }).appendTo($grid);
        }

        // Completion dot: bottom in default mode, top in bottom-up mode.
        if (!allComplete) return;

        var last      = segments[segments.length - 1];
        var lineWidth = Math.max(1, last.avg / 100 * 25);
        var dotSize   = Math.max(4, lineWidth * 2);
        var dotTop    = bottomUp
            ? (last.top - dotSize / 2)
            : (last.bottom - dotSize / 2);

        $('<div class="kosmicka-vertikala-line kosmicka-vertikala-dot"></div>').css({
            position:      'absolute',
            top:           dotTop + 'px',
            left:          (last.centerX - dotSize / 2) + 'px',
            width:         dotSize + 'px',
            height:        dotSize + 'px',
            background:    '#ffd700',
            borderRadius:  '50%',
            pointerEvents: 'none',
            zIndex:        4,
        }).appendTo($grid);
    }
