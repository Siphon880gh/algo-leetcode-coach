You get an array of objects (or arrays) that may be nested and may hold numbers, strings, booleans and null. Build a matrix: the first row lists column names, which are the paths from each object’s root to its leaf values, and each later row holds one object’s value for every column, with an empty marker where the object has no value. How paths are written, the column order and the empty marker are in the official statement. For instance, two objects with keys b and a and no nesting give the header a, b followed by one row per object. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Flatten, union, fill

1. `flat(v, prefix)`: for each own key k, extend the path; recurse into non-null objects and arrays, otherwise record the leaf value.
2. `keys` = sorted union of every object’s paths.
3. Rows: for each object, map `keys` to its value, or the empty marker when missing.

Constructed checks (run in Node, with dot-joined paths and an empty string as the marker for illustration): two flat objects → header a, b and rows [2,1], [4,3]; {a: 1} and {b: 2} → rows [1, empty] and [empty, 2]; a nested {x: {y: 1}, z: [5]} → columns x.y and z.0.

Treat null as a leaf, not as an object to recurse into, since typeof null is object.

Time: O(total size + columns · objects)  
Space: O(columns · objects)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
