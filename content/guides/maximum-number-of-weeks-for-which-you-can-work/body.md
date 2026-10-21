## Interleave around the biggest

1. `s = sum`, `mx = max`, `rest = s − mx`.
2. Return `s` if `mx ≤ rest + 1`, else `2 · rest + 1`.

`[1,2,3]` → 6. `[5,2,1]` → 7. Checked against a full search on small inputs.

The largest project needs a different milestone between any two of its own; with `rest` separators it can take at most `rest + 1` weeks. Sums reach 10^14, so use 64-bit.

Time: O(n)  
Space: O(1)

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
