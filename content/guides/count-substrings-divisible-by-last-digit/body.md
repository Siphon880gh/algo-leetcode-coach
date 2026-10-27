## 45 counters

1. f[d][r] for d = 1 … 9, r < d.
2. For each digit c: new[d][(10r + c) mod d] += f[d][r]; new[d][c mod d] += 1.
3. If c > 0, answer += f[c][0].

Examples → 11, 18, 25. Checked against every substring on 300 random strings.

Testing only the last two digits: example 1 → 13 instead of 11.

Time: O(45 · n)  
Space: O(45)

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
