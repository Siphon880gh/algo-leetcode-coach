## Most remaining first

1. Max-heap of `(count, letter)` for positive counts.
2. Pop the top; if the string ends with two of it, pop the next instead (stop if none), append it, and push the first back.
3. Otherwise append the top; push it back if copies remain.

`a = 1, b = 1, c = 7` → `"ccaccbcc"`. `a = 7, b = 1, c = 0` → `"aabaa"`. Any longest valid string is accepted.

Do not place letters in fixed rotation; the most frequent letter must lead. Do not allow three in a row.

Time: O(a + b + c)  
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
