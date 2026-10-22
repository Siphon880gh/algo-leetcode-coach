## Prefix map

1. `cnt = {0: 1}`, `p = 0`.
2. For each x: `p = (p + [x % modulo = k]) % modulo`; add `cnt[(p − k) % modulo]`; `cnt[p] += 1`.

Examples → 3, 2. Checked against testing every subarray on 300 random inputs.

Seed the map with the empty prefix: without it the examples → 0 and 1. modulo reaches 10^9, so use a hash map, not an array. The count reaches about 5 · 10^9, so use 64-bit.

Time: O(n)  
Space: O(n)

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
