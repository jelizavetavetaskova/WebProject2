const topSongs = [
    {
        "id": 5,
        "name": "Don't hate yourself but don't love yourself too much",
        "description": "Don't hate yourself, but don't love yourself too much\n\r\nThere are million, millions of your kind\n\r\nThink you're special, but you're not\n\r\nReally, don't hate yourself, but don't love yourself too much\n\r\nMommy said you're a special boy, but you're really not",
        "artist": "Baby Lasagna",
        "genre": null,
        "album": "DMNS & MOSQUITOES",
        "year": 2025,
        "image": "http://localhost/images/6839899002363.jpg"
    },
    {
        "id": 3,
        "name": "World in Fire",
        "description": null,
        "artist": "MILKOVSKYI",
        "genre": null,
        "album": "Can't return home",
        "year": 2018,
        "image": "http://localhost/images"
    },
    {
        "id": 4,
        "name": "Return home",
        "description": "123",
        "artist": "MILKOVSKYI",
        "genre": null,
        "album": "Return Home",
        "year": 2009,
        "image": "http://localhost/images"
    }
];

const selectedSong = {
        "id": 5,
        "name": "Don't hate yourself but don't love yourself too much",
        "description": "Don't hate yourself, but don't love yourself too much\r\nThere are million, millions of your kind\r\nThink you're special, but you're not\r\nReally, don't hate yourself, but don't love yourself too much\r\nMommy said you're a special boy, but you're really not\r\n\r\nToxic positivity and everything's okay, guess what?\r\nThere's no possibility of things always going your way\r\nC-C-Comparing is despairing, your worth is not in likes\r\nThere's no motivational quote to fix your broken life, oh\r\n\r\nDon't hate yourself, but don't love yourself too much\r\nThere are million, millions of your kind\r\nThink you're special, but you're not\r\nReally, don't hate yourself, but don't love yourself too much\r\nMommy said you're a special boy, but you're really not\r\n\r\nNo matter how many v-v-videos you're watching\r\nNot gonna change your brain into thinking positive thoughts\r\nThere is no easy way, no one size fits all\r\nQuit looking for salvation on your fucking phone\r\n\r\nDon't hate yourself, but don't love yourself too much\r\nThere are million, millions of your kind\r\nThink you're special, but you're not\r\nReally, don't hate yourself, but don't love yourself too much\r\nMommy said you're a special boy, but you're really not\r\n\r\nLa-la-la-la-la, la-la-la-la-la-la\r\nLa-la-la-la, la-la-la-la\r\nLa-la-la-la-la, la-la-la-la-la-la\r\nLa-la-la-la, la-la-la-la\r\n\r\nNarcissistic culture has reached its peak\r\nFeels a lot like Rome, feels a lot like Greece (oh, no)\r\nI'm no better, don't get me wrong\r\nI'm as ugly as anybody, let's all sing along, oh\r\n\r\nDon't hate yourself, but don't love yourself too much\r\nThere are million, millions of your kind\r\nThink you're special, but you're not\r\nReally, don't hate yourself, but don't love yourself too much\r\nMommy said you're a special boy, but you're really not\r\n\r\nDon't hate yourself, but don't love yourself too much\r\nThere are million, millions of your kind\r\nThink you're special, but you're not\r\nReally, don't hate yourself, but don't love yourself too much\r\nMommy said you're a special boy, but you're really not",
        "artist": "Baby Lasagna",
        "genre": null,
        "album": "DMNS & MOSQUITOES",
        "year": 2025,
        "spotify": null,
        "image": "http://localhost/images/6839899002363.jpg"
};

const relatedSongs = [
    {
        "id": 6,
        "name": "Europapa",
        "description": null,
        "artist": "Joost",
        "genre": null,
        "album": "Unity",
        "year": 2018,
        "image": "http://localhost/images"
    },
    {
        "id": 5,
        "name": "Don't hate yourself but don't love yourself too much",
        "description": "Don't hate yourself, but don't love yourself too much\\n\r\nThere are million, millions of your kind\\n\r\nThink you're special, but you're not\\n\r\nReally, don't hate yourself, but don't love yourself too much\\n\r\nMommy said you're a special boy, but you're really not",
        "artist": "Baby Lasagna",
        "genre": null,
        "album": "DMNS & MOSQUITOES",
        "year": 2025,
        "image": "http://localhost/images/6839899002363.jpg"
    },
    {
        "id": 4,
        "name": "Return home",
        "description": "123",
        "artist": "MILKOVSKYI",
        "genre": null,
        "album": "Return Home",
        "year": 2009,
        "image": "http://localhost/images"
    }
]


// Galvenā lietotnes komponente
export default function App() {
    // funkcija Song ID saglabāšanai stāvoklī
    function handleSongSelection(songID) {
        alert("Chosen ID: " + songID);
    }

    // funkcija dziesmas izveles atcelsanai
    function handleGoingBack() {
        alert("Going back to Homepage")
    }

    const selectedSongID = 5; // pagaidu stavokla mainigais



    return (
        <>
            <Header />
            <main className="mb-8 px-2 md:container md:mx-auto">
                
                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                    {/* <Homepage handleSongSelection={handleSongSelection} /> */}
                </div>
                
                
                    <SongPage 
                            selectedSongID={selectedSongID}
                            handleSongSelection={handleSongSelection}
                            handleGoingBack={handleGoingBack}
                        />
                
                
            </main>
            <Footer />
        </>
    )
}

// Sākumlapa - ielādē datus no API un parāda TOP dziesmas
function Homepage({ handleSongSelection }) {
    return (
        <>
            {
                topSongs.map((song, index) =>
                    <TopSongView
                        song={song}
                        key={song.id}
                        index={index}
                        handleSongSelection={handleSongSelection}
                    />
                )
            }
        </>
    );
}

// Top grāmatas skats- attēlo sākumlapas grāmatas
function TopSongView({ song, index, handleSongSelection }) {
    return (
        <div className="rounded-xl p-4 flex flex-col items-center text-center border border-solid border-black">
            <img 
                src={song.image} 
                alt={song.name} 
                className="w-40 h-40 rounded-lg mb-4" />
            <h2 className="text-xl font-semibold">{song.name}</h2>
            <p className="text-gray-600 mb-4">{song.artist.name}</p>
            <div className="flex gap-2">
                <a href="#" className="bg-[#1DB954] text-white px-3 py-2 rounded text-sm">Listen</a>
                <SeeMoreBtn 
                    songID={song.id} 
                    handleSongSelection={handleSongSelection} 
                />
            </div>
        </div>
    )
}

// TODO:  Gramatas lapa - strukturala komponente, kas satur gramatu lapas komponentes
function SongPage({ selectedSongID, handleSongSelection, handleGoingBack }) {
    return (
        <>
            <div className="grid grid-cols-[2fr_2fr_0.5fr]">
                <SelectedSongView 
                    selectedSongID={selectedSongID}
                    handleGoingBack={handleGoingBack}
                />
            </div>

            <h2 className="text-2xl font-bold text-center mt-10 mb-10 w-full">Similar songs</h2>
            <div className="grid grid-cols-3 justify-around">
                <RelatedSongSection 
                    selectedSongID={selectedSongID}
                    handleSongSelection={handleSongSelection}
                />
            </div>
        </>
    )
}



function SelectedSongView({ selectedSongID, handleGoingBack }) {
    return (
        <> 
            <div className="flex flex-col ml-20">
                <div>
                    <img src={selectedSong.image} alt={selectedSong.name} className="w-96 rounded-lg" />
                </div>
                <h1 className="text-2xl font-bold mb-1 w-3/4">{selectedSong.name}</h1>
                <p className="text-lg text-gray-700 mb-4">{selectedSong.artist}</p>
                <p>{selectedSong.album}</p>
                {selectedSong.spotify ?
                    (<a href={selectedSong.spotify} target="_blank" className="inline-block py-1 px-2 bg-[#1DB954] text-white w-3/4 text-center rounded-lg">Listen on Spotify</a>) :
                    (<span className="inline-block py-1 px-2 bg-gray-400 text-white w-3/4 text-center rounded-lg text-sm opacity-50 cursor-not-allowed ">No Spotify link</span>)
                }
            </div>
            <div className="flex flex-col">
                {selectedSong.description
  ? selectedSong.description.split('\n').map((line, index) => (
      <p key={index} className="block h-5">{line}</p>
    ))
  : <p>No description</p>}
            </div>
            <div className="mb-12 flex flex-col ml-20">
                <GoBackBtn handleGoingBack={handleGoingBack} />
            </div>
        </>
    )
}

function GoBackBtn({ handleGoingBack }) {
    return (
        <button
            className="inline-block rounded-full py-2 px-4 bg-neutral-500
            hover:bg-neutral-400 text-neutral-50 cursor-pointer"
            onClick={handleGoingBack}
        >
            Back
        </button>
    )
}

// Līdzīgo dziesmu sadaļa
function RelatedSongSection({ selectedSongID, handleSongSelection }) {
    return (
        <>
            {relatedSongs.map(song => (
                <RelatedSongView
                    song={song}
                    key={song.id}
                    handleSongSelection={handleSongSelection}
                />
            ))}
        </>
    )
}

function RelatedSongView({ song, handleSongSelection }) {
    return (
        <>
            <div className="flex flex-col items-center border border-solid border-black rounded-lg p-6 m-2">
                {song.image && song.image !== 'http://localhost/images' ? 
                    (<img src={song.image} alt={song.name} className="w-48 h-48" />) : 
                    (<div className="w-48 h-48 bg-gray-300 rounded flex items-center justify-center text-gray-600"></div>)
                }
                <p className="text-center text-xl font-semibold">{song.name}</p>
                <p className="text-center text-gray-600 mb-5">{song.artist}</p>
                <SeeMoreBtn
                    songID={song.id}
                    handleSongSelection={handleSongSelection}
                />
            </div>
        </>
    )
}

// Poga "See more"
function SeeMoreBtn({ songID, handleSongSelection }) {
    return (
        <button
        className="inline-block rounded py-1 px-3 border border-solid border-black hover:bg-gray-400 cursor-pointer"
        onClick={() => handleSongSelection(songID)}>
            About
        </button>
    )
}

// Galvene un kājene – strukturālas komponentes bez funkcijām vai datiem
function Header() {
    return (
        <header className="bg-green-500 mb-8 py-2 sticky top-0">
            <div className="px-2 py-2 font-serif text-green-50 text-xl leading-6 md:container md:mx-auto">
                2. Praktiskais Darbs
            </div>
        </header>
    )
}

function Footer() {
    return (
        <footer className="bg-neutral-300 mt-8">
            <div className="py-8 md:container md:mx-auto px-2">
                J. Vetaškova, VeA, 2025
            </div>
        </footer>
    )
}