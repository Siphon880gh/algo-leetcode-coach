## Case analysis

1. Sorted → 0. n ≤ 2 → −1.
2. s[0] = min(s) or s[n − 1] = max(s) → 1 (sort the rest).
3. min(s) occurs in s[0 … n − 2] (sort that, then s[1 …]) or max(s) occurs in s[1 …] → 2.
4. Otherwise → 3 (sort s[… n − 2], s[1 …], s[… n − 2]).

Examples → 1, 2, −1. Checked against a BFS over every allowed sort on 1,500 random strings.

Never answering 3: constructed check (run in code) "cba" → 2 instead of 3.

Time: O(n)  
Space: O(1)

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
