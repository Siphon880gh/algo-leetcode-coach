Design `LFUCache(capacity)` with `get(key)` and `put(key, value)`, each in O(1) average time. Capacity 1 to 1e4, up to 2e5 calls. Each key has a use count: a new key starts at 1, and every `get` or `put` on it adds 1. When the cache is full and a new key arrives, evict the key with the smallest count; on a tie, evict the least recently used of those.

## Two maps and per-frequency LRU lists

- `nodes[key]` → node holding `key`, `value`, `freq`.
- `lists[f]` → a doubly linked list of nodes with count `f`, most recently used at the front.
- `minFreq` → the smallest count currently present.

Touch a node (on `get` or on `put` of an existing key): remove it from `lists[freq]`. If that list is now empty and `freq == minFreq`, increment `minFreq`. Increase `freq` and add the node to the front of `lists[freq]`.

`put` of a new key when full: remove the node at the back of `lists[minFreq]` and delete it from `nodes`. Then insert the new node with `freq = 1` at the front of `lists[1]` and set `minFreq = 1`.

LRU Cache (146) is one list ordered by recency. All O(1) Data Structure (432) also buckets by count but does not evict.

Do not scan for the minimum count. Do not forget that `put` on an existing key also counts as a use. Do not evict when the key already exists. Capacity 0 (if allowed in a variant) means `put` does nothing.

Time: O(1) per call  
Space: O(capacity)

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
