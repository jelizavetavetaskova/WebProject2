import { useEffect, useState } from "react";
import '../css/loader.css';

// Galvenā lietotnes komponente
export default function App() {
    const [selectedSongID, setSelectedSongID] = useState(null);
    // funkcija Song ID saglabāšanai stāvoklī
    function handleSongSelection(songID) {
        setSelectedSongID(songID);
    }

    // funkcija dziesmas izveles atcelsanai
    function handleGoingBack() {
        setSelectedSongID(null);
    }

    return (
        <>
            <Header />
            <main className="mb-8 px-2 md:container md:mx-auto">
                {selectedSongID ?
                    <SongPage
                        selectedSongID={selectedSongID}
                        handleSongSelection={handleSongSelection}
                        handleGoingBack={handleGoingBack}
                    />
                    :
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                        <Homepage handleSongSelection={handleSongSelection} />
                    </div>
                }
            </main>
            <Footer />
        </>
    )
}

// Sākumlapa - ielādē datus no API un parāda TOP dziesmas
function Homepage({ handleSongSelection }) {
    const [topSongs, setTopSongs] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function () {
        async function fetchTopSongs() {
            try {
                setIsLoading(true);
                setError(null);
                const response = await fetch("http://localhost/data/get-top-songs");

                if (!response.ok) {
                    throw new Error("Data loading error. Please refresh the page");
                }

                const data = await response.json();
                console.log('top songs fetched', data);
                setTopSongs(data);
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        fetchTopSongs();
    }, []);

    return (
        <>
            {isLoading && <Loader />}
            {error && <ErrorMessage msg={error} />}
            {!isLoading && !error &&
                (topSongs.map((song, index) =>
                    <TopSongView
                        song={song}
                        key={song.id}
                        index={index}
                        handleSongSelection={handleSongSelection}
                    />
                ))
            }
        </>
    );
}

// Top grāmatas skats- attēlo sākumlapas grāmatas
function TopSongView({ song, index, handleSongSelection }) {
    return (
        <div className="rounded-xl p-4 flex flex-col items-center text-center border border-solid border-black">
            {song.image && song.image !== 'http://localhost/images' ?
                (<img src={song.image} alt={song.name} className="w-48 h-48" />) :
                (<div className="w-48 h-48 bg-gray-300 rounded flex items-center justify-center text-gray-600"></div>)
            }
            <h2 className="text-xl font-semibold">{song.name}</h2>
            <p className="text-gray-600 mb-4">{song.artist}</p>

            <SeeMoreBtn
                songID={song.id}
                handleSongSelection={handleSongSelection}
            />
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
    const [selectedSong, setSelectedSong] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function () {
        async function fetchSelectedSong() {
            try {
                setIsLoading(true);
                setError(null);
                const response = await fetch('http://localhost/data/get-song/' + selectedSongID)

                if (!response.ok) {
                    throw new Error("Data loading error. Please refresh the page.");
                }

                const data = await response.json();
                console.log('song' + selectedSongID + ' fetched', data);
                setSelectedSong(data);
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        fetchSelectedSong();
    }, [selectedSongID]);

    return (
        <>
            {isLoading && <Loader />}
            {error && <ErrorMessage msg={error} />}
            {!isLoading && !error && <>
                <div className="flex flex-col ml-20">
                    <div>
                        {selectedSong.image && selectedSong.image !== 'http://localhost/images' ?
                            (<img src={selectedSong.image} alt={selectedSong.name} className="w-96 h-96 rounded-lg" />) :
                            (<div className="w-48 h-48 bg-gray-300 rounded flex items-center justify-center text-gray-600 rounded-lg"></div>)
                        }
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
            </>}
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
    const [relatedSongs, setRelatedSongs] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function () {
        async function fetchRelatedSongs() {
            try {
                setIsLoading(true);
                setError(null);
                const response = await fetch('http://localhost/data/get-related-songs/' + selectedSongID)

                if (!response.ok) {
                    throw new Error("Data loading error. Please refresh the page.");
                }

                const data = await response.json();
                console.log('song' + selectedSongID + ' fetched', data);
                setRelatedSongs(data);
            } catch (error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        fetchRelatedSongs();
    }, []);

    return (
        <>
            {isLoading && <Loader />}
            {error && <ErrorMessage msg={error} />}
            {!isLoading && !error &&
                (relatedSongs.map(song => (
                    <RelatedSongView
                        song={song}
                        key={song.id}
                        handleSongSelection={handleSongSelection}
                    />)
            ))
        }
        </>
    );
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

// Ielade un kludas
function Loader() {
    return (
        <div className="my-12 px-2 md:container md:mx-auto text-center clear-both">
            <div className="loader"></div>
        </div>
    )
}

function ErrorMessage({ msg }) {
    return (
        <div className="md:container md:mx-auto bg-red-300 my-8 p-2">
            <p className="text-black">{msg}</p>
        </div>
    )
}