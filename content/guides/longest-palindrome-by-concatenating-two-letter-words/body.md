## Count mirror pairs

1. `c` = counter of words.
2. For `w` with distinct letters: add `4 · min(c[w], c[reverse(w)])` once per unordered pair.
3. For `w` with equal letters: add `4 · (c[w] // 2)`; if any such count is odd, allow a centre.
4. Add 2 if a centre exists.

Examples → 6, 8, 2. Checked against trying every ordered selection on small random inputs.

A palindrome reads its words mirrored around the centre, so each word on the left needs its reverse on the right. Only one word can sit alone in the middle, and only if it is its own reverse.

Time: O(n)  
Space: O(n)

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
