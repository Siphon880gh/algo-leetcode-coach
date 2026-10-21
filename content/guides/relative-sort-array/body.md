## Counts, then two sweeps

Values are at most 1000.

1. `cnt[v]` = occurrences of `v` in `arr1`.
2. For each `v` in `arr2`: output `v` `cnt[v]` times; set `cnt[v] = 0`.
3. For `v` from 0 to 1000: output `v` `cnt[v]` times.

The second sweep is already ascending because it walks values in order.

Do not sort with a comparator that searches `arr2` for each comparison; that adds a factor of `len(arr2)`. A map from value to its index in `arr2` makes a comparator version O(n log n).

Time: O(n + 1001)  
Space: O(1001)

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
