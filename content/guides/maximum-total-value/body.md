## Cutoff

1. cnt(T) = Σ max(0, ⌊(value − T) / decay⌋ + 1) over value ≥ T.
2. cnt(1) ≤ m → take every positive gain.
3. Else find the largest T with cnt(T) ≥ m. Answer = Σ gains ≥ T + 1 plus (m − cnt(T + 1)) · T, mod 10^9 + 7.

Sum exactly (big integers or 128-bit) and reduce at the end. Examples → 19, 11, 7. Checked against a max-heap simulation on 2,000 random cases.

Spending all m picks even on negative gains: example 3 → 0 instead of 7.

Time: O(n log V)  
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
