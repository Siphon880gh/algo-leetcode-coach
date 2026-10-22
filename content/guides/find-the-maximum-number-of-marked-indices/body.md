## Halves

1. Sort; `i = 0`.
2. For `j = ceil(n / 2) … n − 1`: if `i < n / 2` and `2 · a[i] ≤ a[j]`, `i++`.
3. Return `2 · i`.

Examples → 2, 4, 0. Checked against trying every set of pairs on 200 random arrays.

If k pairs exist, the k smallest values can play the small role against the k largest, so restricting to halves loses nothing. 2 · a[i] can reach 2 · 10^9, so use 64-bit.

Time: O(n log n)  
Space: O(1) besides sorting

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
