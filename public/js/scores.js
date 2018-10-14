function fetchScores() {
    axios
        .get('https://www.nfl.com/liveupdate/scorestrip/ss.xml')
        .then(res => console.log(res));
}

document.getElementById('fetch-scores').addEventListener('click', fetchScores);
