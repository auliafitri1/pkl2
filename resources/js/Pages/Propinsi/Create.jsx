import React from "react";

export default function Create({ errors }) {
    return (
        <div className="py-4">
            <h1 className="text-2xl font-bold mb-1">Tambah Propinsi</h1>
            <p className="text-sm text-gray-500 mb-4">isi form di bawahuntuk menambahkan data</p>

            {errors && Object.keys(errors).length > 0 && (
                <div className="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm"> 
                <ul className="list-disc pl-5 space-y-1"> 
                    {Object.values(errors).map((error, index) => (
                        <li key={index}>{error}</li>
                    ))}
                    </ul>
                    </div>
            )}
        
        <form action="/propinsi" method="POST" className="max-w-2xl">
            <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')} />

               <div className="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-4 space-y-4">

                <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">ID Propinsi:</label><br/>
            <input type="number" name="IdPropinsi" required 
            className="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"/>
        </div>
            
        <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Nama Propinsi:</label><br/>
            <input type="text" name="Propinsi" required
            className="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"/>
        </div>
            
        <div>
             <label className="block text-sm font-medium text-gray-700 mb-1">ID Negara:</label><br/>
            <input type="text" name="IdNegara" value="1"  required
            className="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"/>
        </div>

        <div>
             <label className="block text-sm font-medium text-gray-700 mb-1">Sort Order:</label><br/>
            <input type="text" name="SortOrder" required
            className="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"/>
        </div>
   

        <div className="flex gap-2">
        <button type="submit" className="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            Simpan</button>
        <a href="/propinsi" className="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg transition">
            Kembali</a>
      
        </div>
        </div>
        </form>
        </div>
    );
}