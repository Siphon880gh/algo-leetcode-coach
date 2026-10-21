## Levels with coin flips

**Node:** `val` and `next[level]`. A head node has `MAX_LEVEL` (about 16) pointers.

- **Find predecessors:** from the top level of the head, move right while `next.val < target`, record the node at each level as `update[level]`, then go down.
- `search(t)`: after finding predecessors, check `update[0].next[0].val == t`.
- `add(n)`: pick `lvl` with `p = 1/2` per extra level; link the new node after `update[i]` for `i < lvl`.
- `erase(n)`: if `update[0].next[0]` has value `n`, unlink that one node at every level where `update[i].next[i]` is it; return whether it existed.

Duplicates are allowed: `add` always inserts, and `erase` removes one copy.

Do not rebuild a sorted array on each add; that is O(n). Do not erase by value at each level independently; with duplicates you could unlink different nodes.

Time: O(log n) expected per operation  
Space: O(n) expected

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
