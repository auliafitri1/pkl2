import React, { useState, useEffect, useRef } from "react";
import axios from "axios";

export default function Index({ data, sort: initialSort, order: initialOrder }) {
    const [isSearchOpen, setIsSearchOpen] = useState(false);
    
    const [sort, setSort] = useState(initialSort || 'IdKabKota');
    const [order, setOrder] = useState(initialOrder || 'asc');

  
    const [items, setItems] = useState(data.data);
    const [page, setPage] = useState(2);
    const [loading, setLoading] = useState(false);
    const [hasMore, setHasMore] = useState(data.next_page_url !== null);
    const containerRef = useRef(null);

    const handleSort = (column) => {
        const newOrder = (sort === column && order === 'asc') ? 'desc' : 'asc';
        window.location.href = `/kabkota?sort=${column}&order=${newOrder}`;
    };

    const sortText = (column) => {
        if (sort === column) {
            return order === 'asc' ? ' (naik)' : ' (turun)';
        }
        return '';
    };

    useEffect(() => {
        const el = containerRef.current;
        if (!el) return;

        const handleScroll = async () => {
            if (loading || !hasMore) return;

            if (el.scrollTop + el.clientHeight >= el.scrollHeight - 100) {
                setLoading(true);
                try {
                
                    const res = await axios.get(`/kabkota/load-more?page=${page}&sort=${sort}&order=${order}`);
                    setItems(prev => [...prev, ...res.data.data]);
                    setHasMore(res.data.hasMore);
                    setPage(res.data.nextPage);
                } catch (error) {
                    console.error(error);
                }
                setLoading(false);
            }
        };

        el.addEventListener('scroll', handleScroll);
        return () => el.removeEventListener('scroll', handleScroll);
    }, [loading, hasMore, page, sort, order]);

    return (
        <div className="py-4">
            <div className="flex justify-between items-center mb-4">
                <div>
                    <h1 className="text-2xl font-bold text-gray-800">Daftar Kabupaten/Kota</h1>
                    <p className="text-sm text-gray-500">Kelola data kabupaten/kota disini</p>
                </div>
                <div className="flex gap-2">
                    <button 
                        onClick={() => setIsSearchOpen(!isSearchOpen)}
                        className="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-4 py-2 rounded-lg shadow-sm transition"
                    >
                        pencarian
                    </button>
                    <a href="/kabkota/create" className="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition">
                        + Tambah Kab/Kota
                    </a>
                </div>
            </div>

            {isSearchOpen && (
                <div className="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-5">
                    <form action="/kabkota" method="GET">
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <input type="text" name="id_kabkota" placeholder="Cari ID..." className="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                            <input type="text" name="kabupatenkota" placeholder="Cari Nama..." className="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                            <input type="text" name="id_propinsi" placeholder="Cari ID Propinsi..." className="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                        </div>
                        <div className="mt-4 flex gap-2">
                            <button type="submit" className="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">Filter</button>
                            <a href="/kabkota" className="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg transition">Reset</a>
                        </div>
                    </form>
                </div>
            )}

            <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div ref={containerRef} className="max-h-[350px] overflow-y-auto">
                    <table className="w-full text-sm">
                        <thead className="bg-gray-50 text-gray-500 text-left border-b border-gray-100 sticky top-0 z-10">
                            <tr>
                               
                                <th className="px-5 py-3 font-medium bg-gray-50 cursor-pointer hover:text-blue-600" onClick={() => handleSort('IdKabKota')}>
                                    ID Kab/Kota {sortText('IdKabKota')}
                                </th>
                                <th className="px-5 py-3 font-medium bg-gray-50 cursor-pointer hover:text-blue-600" onClick={() => handleSort('KabupatenKota')}>
                                    Nama Kabupaten/Kota {sortText('KabupatenKota')}
                                </th>
                                <th className="px-5 py-3 font-medium bg-gray-50 cursor-pointer hover:text-blue-600" onClick={() => handleSort('IdPropinsi')}>
                                    ID Propinsi {sortText('IdPropinsi')}
                                </th>
                                <th className="px-5 py-3 font-medium bg-gray-50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-100">
                            {items.map((item, index) => (
                                <tr key={item.IdKabKota} className={`${index % 2 === 0 ? 'bg-white' : 'bg-blue-50'} hover:bg-blue-100 transition`}>
                                 
                                    <td className="px-5 py-3 text-gray-600">{item.IdKabKota}</td>
                                    <td className="px-5 py-3 font-medium text-gray-800">{item.KabupatenKota}</td>
                                    <td className="px-5 py-3 text-gray-600">{item.IdPropinsi}</td>
                                    <td className="px-5 py-3 text-right space-x-2">
                                        <a href={`/kabkota/${item.IdKabKota}/edit`} className="text-blue-600 hover:text-blue-800 font-medium text-sm">Edit</a>
                                        <button className="text-red-500 hover:text-red-700 font-medium text-sm">Hapus</button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>

                  
                    {loading && (
                        <div className="text-center py-4">
                            <span className="inline-block w-6 h-6 border-2 border-blue-600 border-t-transparent rounded-full animate-spin"></span>
                        </div>
                    )}
                    {!hasMore && <div className="text-center py-4 text-sm text-gray-400">semua data sudah di tampilkan</div>}
                </div>
            </div>
            
            <p className="text-sm text-gray-500 mt-3">
                Menampilkan {items.length} data dari {data.total} total data
            </p>
        </div>
    );
}