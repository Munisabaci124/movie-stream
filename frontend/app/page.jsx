"use client";

import Image from "next/image";
import Link from "next/link";
import { useSearchParams } from "next/navigation";
import { useEffect, useState } from "react";
import { FaPlayCircle, FaSearch } from "react-icons/fa";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";

// fungsi untuk mengambil data movie
const getMovies = async (params) => {
  const filter = params?.filter || "";
  const search = params?.search || "";
  const res = await fetch(
    `http://localhost:8000/api/movies${filter ? `?filter=${filter}` : ""}${
      search ? `?search=${search}` : ""
    }`,
    {
      next: {
        revalidate: 60,
      },
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    }
  );

  return res.json();
};

// fungsi untuk mengambil data category
const getCategories = async () => {
  const res = await fetch("http://localhost:8000/api/categories", {
    next: {
      revalidate: 60,
    },
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  });

  return res.json();
};

// komponen utama halaman
export default function Home() {
  const params = useSearchParams();
  // deklarasi state untuk menyimpan data
  const [movies, setMovies] = useState([]);
  const [categories, setCategories] = useState([]);
  const [queryFilter, setQueryFilter] = useState(params.get("filter"));
  const [querySearch, setQuerySearch] = useState(params.get("search"));

  // fungsi untuk mengambil data ketika halaman pertama kali diakses
  useEffect(() => {
    const fetchData = async () => {
      if (queryFilter) {
        setMovies(await getMovies({ filter: queryFilter }));
      } else if (querySearch) {
        setMovies(await getMovies({ search: querySearch }));
      } else {
        setMovies(await getMovies());
      }
      setCategories(await getCategories());
    };
    fetchData();
  }, [queryFilter, querySearch]);

  // render halaman
  return (
    <>
      <header className="text-white shadow-md">
        <nav className="container mx-auto px-4 py-4 flex items-center justify-between">
          {/* Logo */}
          <div className="text-2xl font-bold font-poppins flex items-center">
            <div className="bg-[#FF6D00] w-10 h-10 rounded-full flex items-center justify-center me-2">
              <FaPlayCircle />
            </div>
            <Link href="/">MovieStream</Link>
          </div>
        </nav>
      </header>

      <main className="container mx-auto px-4 py-4">
        <div className="flex">
          <div className="w-1/4 mb-4 mt-8">
            <h1 className="text-2xl font-roboto font-bold">
              Filter Categories
            </h1>
            <div className="mt-4">
              {categories.map((category, index) => (
                <button
                  className={`mb-2 mr-2 px-4 py-2 rounded-full ${
                    queryFilter === category.slug
                      ? "bg-[#FF6D00]"
                      : "bg-[#373737]"
                  }`}
                  key={index}
                  onClick={() => {
                    setQueryFilter(category.slug);
                    setQuerySearch("");
                    window.history.pushState(
                      {},
                      "",
                      `?filter=${category.slug}`
                    );
                  }}
                >
                  {category.name}
                </button>
              ))}
            </div>
            <button
              className="mt-4 px-4 py-2 rounded-full bg-red-500"
              onClick={() => {
                setQueryFilter("");
                setQuerySearch("");
                window.history.pushState({}, "", "/");
              }}
            >
              Reset
            </button>
          </div>
          <div className="w-3/4">
            <div className="flex justify-between items-center">
              <div className="flex items-center mb-4 mt-8">
                <div className="w-8 border-t-2 border-white mr-4"></div>
                <h1 className="text-2xl font-poppins font-bold">Movies</h1>
              </div>
              <button className="relative flex mt-4">
                <input
                  type="text"
                  className="px-4 py-2 rounded-full"
                  placeholder="Search"
                  value={querySearch || ""}
                  onChange={(e) => {
                    setQuerySearch(e.target.value);
                    setQueryFilter("");
                    window.history.pushState(
                      {},
                      "",
                      `?search=${e.target.value}`
                    );
                  }}
                />
                <FaSearch className="absolute top-1/2 right-2 transform -translate-y-1/2" />
              </button>
            </div>
            <div className="grid grid-cols-5 gap-4">
              {movies.map((movie, index) => (
                <Dialog key={index}>
                  <DialogTrigger>
                    <div className="h-full">
                      <Image
                        src={"/images/" + movie.thumbnail_url}
                        width={200}
                        height={200}
                        alt="image movie"
                        className="h-[80%] w-full object-cover"
                      />
                      <h1 className="text-center text-lg">{movie.title}</h1>
                    </div>
                  </DialogTrigger>
                  <DialogContent>
                    <DialogHeader>
                      <DialogTitle className="text-2xl text-center">
                        {movie.title}
                      </DialogTitle>
                      <h1 className="font-bold text-lg">Detail</h1>
                      <DialogDescription>
                        {movie.detail.description}
                      </DialogDescription>
                      <DialogDescription>
                        Duration : {movie.detail.duration} menit
                      </DialogDescription>
                      <DialogDescription>
                        Rating : {movie.detail.rating}
                      </DialogDescription>
                    </DialogHeader>
                  </DialogContent>
                </Dialog>
              ))}
            </div>
          </div>
        </div>
      </main>
    </>
  );
}
