$(document).ready(function () {
    $(document).on('click', "#prijaviSe", function () {
        let ispravno = true;
        let poruke = [];

        let ime = document.getElementById("ime");
        let email = document.getElementById('email');
        let sifra = document.getElementById('sifra');
        let adresa = document.getElementById('adresa');
        let vrsta_isporuke = document.getElementById('vrstaIsporuke');

        if (!validacijaImeIPrezime()) {
            ispravno = false;
            poruke.push("Ime i prezime moraju početi velikim slovom i sadržati barem 3 karaktera!");
        }

        if (!validacijaEmail()) {
            ispravno = false;
            poruke.push("Email nije u ispravnom formatu!")
        }

        if (!validacijaSifra()) {
            ispravno = false;
            poruke.push("Šifra mora imati velika i mala slova, barem po jedan broj i znak!")
        }

        if (!validacijaAdresa()) {
            ispravno = false;
            poruke.push("Adresa nije u ispravnom formatu!");
        }

        if (!validacijaPrijave()) {
            ispravno = false;
            poruke.push("Odaberite vrstu isporuke!");
        }

        if (!validacijaRadio()) {
            ispravno = false;
            poruke.push("Odaberite pol!");
        }

        if (ispravno) {
            let podaci = {
                ime: $(ime).val(),
                email: $(email).val(),
                sifra: $(sifra).val(),
                adresa: $(adresa).val(),
                vrstaIsporuke: $(vrsta_isporuke).val(),
                pol: $("input[name='pol']:checked").val()
            };

            let span = document.getElementById("prijavaSpan");
            span.innerHTML = "Uspešno ste se prijavili!";
            span.style.color = 'lightgreen';

            $.ajax({
                url: "../models/funkcije/validacijaForme.php",
                method: "POST",
                data: podaci,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.hasOwnProperty("uspeh") && response.uspeh) {
                        $('#prijavaSpan').text(response.poruka).css('color', 'lightgreen');
                        $('#pocetnaSpan').html("<a href='../views/prodavnica.php'>Nazad na kupovinu</a>");
                    } else {
                        $('#loginSpan').text(response.poruke.join(", "));
                        $('#prijava').css('display', 'none');
                        $('#vecPostojiNalog').css('display', 'none');
                        $('#formaZaLogovanje').css('display', 'block');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', status, error);
                    $('#prijavaSpan').text('Došlo je do greške. Pokušajte ponovo.').css('color', 'red');
                }
            });
        } else {
            let span = document.getElementById("prijavaSpan");
            span.innerHTML = poruke.join("<br>");
            span.classList.remove("uspesno");
            span.classList.add("greska");
            span.classList.add("vidljiv");
        }

        $("#vecPostojiNalog").css('display', 'none');
    });
});

function validacijaImeIPrezime() {
    let imeRegEx = /^[A-Z][a-z]{2,}(\s[A-Z][a-z]{2,})*$/;
    let ime = document.getElementById('ime').value;

    if (imeRegEx.test(ime)) {
        return true;
    } else {
        let span = document.getElementById("prijavaSpan");
        span.innerHTML = "Ime i prezime moraju početi velikim slovom i sadržati barem 3 karaktera!"
        span.classList.remove("uspesno");
        span.classList.add("greska");

        return false;
    }
}

function validacijaAdresa() {
    let adresaRegEx = /^(\d{1,5})?\s*([a-zA-ZćčžšđĆČŽŠĐ]+\s*)+\d{0,5}(\s*[,.-]?\s*[a-zA-ZćčžšđĆČŽŠĐ]+\s*\d{0,5})*$/;
    let adresa = document.getElementById('adresa').value;

    if (adresaRegEx.test(adresa)) {
        return true;
    } else {
        let span = document.getElementById("prijavaSpan");
        span.innerHTML = "Adresa nije u ispravnom formatu!"
        span.classList.remove("uspesno");
        span.classList.add("greska");

        return false;
    }
}

function validacijaPrijave() {
    let isporuka = document.getElementById("vrstaIsporuke").value;

    if (isporuka === "0") {
        let span = document.getElementById("prijavaSpan");
        span.innerHTML = "Odaberite vrstu isporuke!";
        span.classList.remove("uspesno");
        span.classList.add("greska");

        return false;
    } else {
        return true;
    }
}

function validacijaRadio() {
    let muskiChecked = document.getElementById("muski").checked;
    let zenskiChecked = document.getElementById("zenski").checked;

    return !(!muskiChecked && !zenskiChecked);
}

function validacijaEmail() {
    let emailRegEx = /^[a-zA-Z0-9._%+-]+@(gmail\.com|ict\.edu\.rs|yahoo\.com)$/;
    let email = document.getElementById('email').value;

    if (emailRegEx.test(email)) {
        return true;
    } else {
        let span = document.getElementById("prijavaSpan");
        span.innerHTML = "Email nije u ispravnom formatu!"
        span.classList.remove("uspesno");
        span.classList.add("greska");

        return false;
    }
}

function validacijaSifra() {
    let sifraRegEx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.!@#$%^&*])[A-Za-z\d.!@#$%^&*]{8,}$/;
    let sifra = document.getElementById('sifra').value;

    if (sifraRegEx.test(sifra)) {
        return true;
    } else {
        let span = document.getElementById("prijavaSpan");
        span.innerHTML = "Sifra mora imati velika i mala slova, barem po jedan broj i znak!";
        span.classList.remove("uspesno");
        span.classList.add("greska");

        return false;
    }
}

//PRIJAVA POCETNA STRANICA
$(document).ready(function () {
    $(document).on('click', "#button1", function () {
        console.log("Button clicked");
        let ispravno = true;
        let poruke = [];

        let email = $('#text').val();
        console.log("Email entered: " + email);

        if (!validacijaEmailNovosti(email)) {
            ispravno = false;
            poruke.push("Email nije u ispravnom formatu!");
        }

        let span = $("#mejlSpan");

        if (ispravno) {
            let podaci = {
                email: email
            };

            span.text("Uspešno ste se prijavili!").css('color', 'lightgreen');

            $.ajax({
                url: "./models/funkcije/prijavaPocetna.php",
                method: "POST",
                data: podaci,
                dataType: "json",
                success: function (response) {
                    console.log("AJAX response:", response);
                    if (response.hasOwnProperty("uspeh") && response.uspeh) {
                        span.text(response.poruka).css('color', 'lightgreen');
                    } else {
                        span.text('Došlo je do greške. Pokušajte ponovo.').css('color', 'red');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    span.text('Došlo je do greške. Pokušajte ponovo.').css('color', 'red');
                }
            });
        } else {
            span.removeClass("uspesno").addClass("greska vidljiv");
            span.text(poruke.join(', ')).css('color', 'red');
        }
    });
});

function validacijaEmailNovosti() {
    let emailRegEx = /^[a-zA-Z0-9._%+-]+@(gmail\.com|ict\.edu\.rs|yahoo\.com)$/;
    let email = document.getElementById('text').value;
    let span = document.getElementById("mejlSpan");

    if (emailRegEx.test(email)) {
        return true;
    } else {
        if (span) {
            span.innerHTML = "Email nije u ispravnom formatu!";
            span.classList.remove("uspesno");
            span.classList.add("greska");
        } else {
            console.error("Element sa ID 'mejlSpan' nije pronađen.");
        }
        return false;
    }
}


document.addEventListener('DOMContentLoaded', function () {
    let dugmeOpis = document.querySelectorAll('.dugme_opis');

    dugmeOpis.forEach(function (dugme) {
        dugme.addEventListener('click', function () {
            let detaljanOpis = this.nextElementSibling;

            if (dugme.value === 'Detaljnije') {
                dugme.value = 'Manje';
            } else {
                dugme.value = 'Detaljnije';
            }

            detaljanOpis.classList.toggle('active');
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    let dugmeZatvori = document.querySelectorAll('.zatvori');

    dugmeZatvori.forEach(function (dugme) {
        dugme.addEventListener('click', function () {
            let roditelj = this.closest('.tekstProizvoda');

            let detaljanOpis = roditelj.querySelector('.detaljan_opis');
            if (detaljanOpis) {
                detaljanOpis.classList.remove('active');
            }

            let dugmeOpis = roditelj.querySelector('.dugme_opis');
            dugmeOpis.value = "Detaljnije";
        });
    });
});

document.addEventListener('change', function () {
    postaviDugmeZatvoriEvent();
});

function postaviDugmeZatvoriEvent() {
    let dugmeOpis = document.querySelectorAll('.dugme_opis');
    let dugmeZatvori = document.querySelectorAll('.zatvori');

    dugmeOpis.forEach(function (dugme) {
        dugme.addEventListener('click', function () {
            let detaljanOpis = this.nextElementSibling;

            if (dugme.value === 'Detaljnije') {
                dugme.value = 'Manje';
            } else {
                dugme.value = 'Detaljnije';
            }

            detaljanOpis.classList.toggle('active');
        });
    });

    dugmeZatvori.forEach(function (dugme) {
        dugme.addEventListener('click', function () {
            let roditelj = this.closest('.tekstProizvoda');

            let detaljanOpis = roditelj.querySelector('.detaljan_opis');
            if (detaljanOpis) {
                detaljanOpis.classList.remove('active');
            }

            let dugmeOpis = roditelj.querySelector('.dugme_opis');
            dugmeOpis.value = "Detaljnije";
        });
    });
}

$(document).ready(function () {
    $('#inputZaFunkciju').keyup(function () {
        postaviDugmeDetaljnijeZaPretragu();
        console.log("keyup");
    });
});

function postaviDugmeDetaljnijeZaPretragu() {
    let dugmeOpis = document.querySelectorAll('.dugme_opis');
    let dugmeZatvori = document.querySelectorAll('.zatvori');

    dugmeOpis.forEach(function (dugme) {
        dugme.addEventListener('click', function () {
            let detaljanOpis = this.nextElementSibling;

            if (this.textContent.trim() === 'Detaljnije') {
                this.textContent = 'Manje';
            } else {
                this.textContent = 'Detaljnije';
            }

            detaljanOpis.classList.toggle('active');
        });
    });

    dugmeZatvori.forEach(function (dugme) {
        dugme.addEventListener('click', function () {
            let roditelj = this.closest('.tekstProizvoda');

            let detaljanOpis = roditelj.querySelector('.detaljan_opis');
            if (detaljanOpis) {
                detaljanOpis.classList.remove('active');
            }

            let dugmeOpis = roditelj.querySelector('.dugme_opis');
            dugmeOpis.textContent = "Detaljnije";
        });
    });
}

//FILTRIRANJE, SORTIRANJE I PRETRAGA
$(document).ready(function () {
    $('#sort').change(function () {
        let sortiranje = $(this).val();
        let kategorija = $('#kategorije').val();

        sacuvajLS('sortiranje', sortiranje);

        $.ajax({
            url: '../models/funkcije/funkcije.php',
            method: 'GET',
            data: {
                action: 'sortirajIFiltrirajProizvode', tip: sortiranje, kategorija: kategorija
            },
            success: function (response) {
                $('#sviProizvodi').html(response);
                postaviDugmeZatvoriEvent();
            },
            error: function (xhr, status, error) {
                console.error(status, error);
            }
        });
    });

    $('#kategorije').change(function () {
        let kategorija = $(this).val();
        sacuvajLS('kategorija', kategorija);

        let sortiranje = procitajLS('sortiranje');

        $.ajax({
            url: '../models/funkcije/funkcije.php',
            method: 'GET',
            data: {
                action: 'sortirajIFiltrirajProizvode',
                tip: sortiranje,
                kategorija: kategorija
            },
            success: function (response) {
                $('#sviProizvodi').html(response);
                postaviDugmeZatvoriEvent();
            },
            error: function (xhr, status, error) {
                console.error(status, error);
            }
        });
    });

    $('#inputZaFunkciju').keyup(function () {
        let pretraga = $(this).val();
        let sortiranje = procitajLS('sortiranje');
        let kategorija = $('#kategorije').val();

        pretraziProizvode(pretraga, sortiranje, kategorija);

        function pretraziProizvode(pretraga, sortiranje, kategorija) {
            $.ajax({
                url: '../models/funkcije/funkcije.php',
                method: 'GET',
                data: {
                    action: 'pretraziProizvode',
                    pretraga: pretraga,
                    tip: sortiranje,
                    kategorija: kategorija
                },
                success: function (response) {
                    $('#sviProizvodi').html(response);
                },
                error: function (xhr, status, error) {
                    console.error(status, error);
                }
            });
        }
    });

    function sacuvajLS(ime, vrednost) {
        localStorage.setItem(ime, JSON.stringify(vrednost));
    }

    function procitajLS(ime) {
        return JSON.parse(localStorage.getItem(ime));
    }
});

//VEC POSTOJI DIV
$(document).ready(function () {
    $('#vecPostojiNalog').click(function (event) {
        event.preventDefault();

        $('#prijava').css('display', 'none');
        $('#vecPostojiNalog').css('display', 'none');
        $('#formaZaLogovanje').css('display', 'block');
    });
});

//PAGINACIJA
$(document).ready(function() {
    function loadPage(strana) {
        $.ajax({
            url: '../../models/funkcije/paginacija.php',
            method: 'GET',
            data: { strana: strana },
            dataType: 'json',
            success: function(response) {
                $('#tabelaKorisnika').html(response.tabela);
                $('#paginacija').html(response.paginacija);
                document.getElementById('listaKorisnika').scrollIntoView({ behavior: 'smooth' });
            },
            error: function(xhr, status, error) {
                console.error('Greška:', error);
            }
        });
    }

    loadPage(1);

    $(document).on('click', '.paginacijaLink a', function(event) {
        event.preventDefault();

        var strana = $(this).data('strana');
        loadPage(strana);
    });
});


//PRIJAVA
$(document).ready(function () {
    $(document).on('click', "#loginSe", function (e) {
        e.preventDefault();

        let ispravno = true;
        let poruke = [];

        let email = $('#emailLog').val();
        let sifra = $('#sifraLog').val();

        if (!validacijaEmail1(email)) {
            ispravno = false;
            poruke.push("Email nije u ispravnom formatu!");
        }

        if (!validacijaSifra1(sifra)) {
            ispravno = false;
            poruke.push("Šifra mora imati velika i mala slova, barem po jedan broj i znak!");
        }

        if (ispravno) {
            let podaci = {
                emailLog: email,
                sifraLog: sifra
            };

            $.ajax({
                url: '../models/funkcije/prijava.php',
                method: "POST",
                data: podaci,
                dataType: "json",
                success: function (response) {
                    if (response.uspeh) {
                        $('#loginSpan').text(response.poruka).css('color', 'lightgreen');
                        $('#loginLinkSpan').html("<a href='../views/prodavnica.php'>Nazad na kupovinu</a>");
                    } else {
                        $('#loginSpan').text(response.poruka).css('color', 'red');
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                    console.log(xhr.responseText);
                    $('#loginSpan').text('Došlo je do greške. Pokušajte ponovo!').css('color', 'red');
                }

            });
        } else {
            $('#loginSpan').html(poruke.join("<br>")).css('color', 'red');
        }
    });
});

function validacijaEmail1(email) {
    let emailRegEx = /^[a-zA-Z0-9._%+-]+@(gmail\.com|ict\.edu\.rs|yahoo\.com)$/;
    return emailRegEx.test(email);
}

function validacijaSifra1(sifra) {
    let sifraRegEx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.!@#$%^&*])[A-Za-z\d.!@#$%^&*]{8,}$/;
    return sifraRegEx.test(sifra);
}



//KONTAKT
$(document).ready(function () {
    $(document).on('click', "#kontaktDugme", function (event) {
        event.preventDefault();

        let ispravno = true;
        let poruke = [];

        let ime = document.getElementById("imeK");
        let email = document.getElementById('emailK');
        let poruka = document.getElementById('poruka');

        if (!validacijaImeIPrezime(ime.value)) {
            ispravno = false;
            poruke.push("Ime i prezime moraju početi velikim slovom i sadržati barem 3 karaktera!");
        }

        if (!validacijaEmail(email.value)) {
            ispravno = false;
            poruke.push("Email nije u ispravnom formatu!");
        }

        if (!poruka.value) {
            ispravno = false;
            poruke.push("Poruka je obavezna!");
        }

        if (ispravno) {
            let podaci = {
                imeK: $(ime).val(),
                emailK: $(email).val(),
                poruka: $(poruka).val()
            };

            $.ajax({
                url: '../models/funkcije/validacijaKontakt.php',
                method: "POST",
                data: podaci,
                dataType: "json",
                success: function (response) {
                    let span = $('#spanKontakt');
                    if (response.hasOwnProperty("uspeh") && response.uspeh) {
                        span.text(response.poruka).css('color', 'lightgreen').show();
                    } else {
                        span.html(response.poruke.join("<br>")).css('color', 'red').show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', status, error);
                    $('#spanKontakt').text('Došlo je do greške. Pokušajte ponovo.').css('color', 'red').show();
                }
            });
        } else {
            let span = $('#spanKontakt');
            span.html(poruke.join("<br>")).css('color', 'red').show();
        }
    });

    function validacijaImeIPrezime(ime) {
        let imeRegEx = /^[A-Z][a-z]{2,}(\s[A-Z][a-z]{2,})*$/;
        return imeRegEx.test(ime);
    }

    function validacijaEmail(email) {
        let emailRegEx = /^[a-zA-Z0-9._%+-]+@(gmail\.com|ict\.edu\.rs|yahoo\.com)$/;
        return emailRegEx.test(email);
    }
});

//PRIJAVA/ODJAVA
$(document).ready(function () {
    $(document).on('click', '#prijavaOdjava', function () {
        $.ajax({
            url: '../models/funkcije/odjava.php',
            method: 'POST',
            dataType: 'json',
            data: {prijavaOdjava: true},
            success: function (response) {
                if (response.uspeh) {
                    $('#prijavaOdjava').text("Prijavite se");

                    window.location.reload();
                } else {
                    alert('Došlo je do greške prilikom odjave.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Greška prilikom Ajax poziva:', error);
            }
        });
    });
});


//TABELA POSETE
document.addEventListener("DOMContentLoaded", function () {
    var rows = document.querySelectorAll("#poseteTabela tbody tr");
    for (var i = 0; i < rows.length; i++) {
        if (i % 2 === 1) {
            rows[i].style.backgroundColor = "#f2f2f2";
        }
    }
});


//STATISTIKA
document.addEventListener('DOMContentLoaded', function () {
    fetch('../models/funkcije/statistika.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('statistika_content').innerHTML = data;
        })
        .catch(error => console.error('Greška pri učitavanju statistike:', error));

    fetch('../models/funkcije/korisnici_logovani.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('korisnici_content').innerHTML = data;
        })
        .catch(error => console.error('Greška pri učitavanju korisnika:', error));
});








