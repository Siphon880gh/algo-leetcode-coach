## Chaining with pairs

`h(key) = key % B` for a prime `B`. Each bucket is a list (or linked list) of `[key, value]` pairs.

- `put(k, v)`: if `k` is in the bucket, overwrite its value; otherwise append `[k, v]`.
- `get(k)`: return the value if found, otherwise `-1`.
- `remove(k)`: delete the pair if found.

Keys and values are in `0 … 10⁶`, so an int array of size `10⁶ + 1` filled with `-1` is the simplest O(1) alternative, with the same memory trade-off as problem 705.

Open addressing (linear probing) also works, but `remove` then needs tombstones so later probes do not stop early.

Do not append a second pair on `put` for an existing key; `get` would return the stale value. Do not use the built-in map.

Time: O(1) average  
Space: O(B + n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
