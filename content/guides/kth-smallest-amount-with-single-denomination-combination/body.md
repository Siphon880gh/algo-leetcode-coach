## Count multiples

1. cnt(x) = Σ over non-empty subsets S of (−1)^(|S|+1) ⌊x / lcm(S)⌋ (at most 2^15 subsets).
2. Smallest x with cnt(x) ≥ k, searching 1 … min(coins) · k.

Examples → 9, 12. Checked against listing multiples on 300 random cases.

Shared multiples count once: adding ⌊x / c⌋ per coin gives example 1 → 6 and example 2 → 10. The answer can reach 25 · 2 · 10^9; use 64-bit.

Time: O(2^c · log(k · min coin))  
Space: O(2^c)

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
