## Feasibility by formula

1. units(t, T) = ⌊(√(1 + 8⌊T / t⌋) − 1) / 2⌋, using an integer square root.
2. Binary search T in [0, min(t) · h(h + 1)/2] for the first T with Σ units ≥ h.

Examples → 3, 12, 15. Checked against an exhaustive split on 200 small cases; the formula was checked exactly for t < 30, T < 500.

Giving every unit to the fastest worker: example 1 → 10 instead of 3. The upper bound reaches about 5 · 10^15; use 64-bit.

Time: O(n log(min(t) · h²))  
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
