## Digit count

1. L = number of digits of n; r = Σ 9^l for l = 1 … L − 1.
2. Scan n’s digits: at digit d (position i), stop if d = 0; else r += (d − 1) · 9^(L − i − 1).
3. If no digit was 0, r += 1 (n itself). Return r.

Examples → 9, 3. Checked against building the set for every n up to 3,000 and 30 random n up to 200,000.

Counting all zero-free numbers with at most L digits (ignoring n): example 1 → 90 instead of 9.

Time: O(log n)  
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
