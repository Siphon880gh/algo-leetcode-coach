## Brute force is enough

1. For each index `i`: count the letters of `word` without position `i`.
2. If the counts of present letters form a single value, return true.
3. Return false.

Examples → true, false. Also aaa → true and ab → true.

Rules on the count of counts are easy to get wrong: aazz has only two distinct counts after any removal, yet the answer is false, and a letter whose count drops to 0 disappears from the check. Trying each removal avoids all of that.

Time: O(n · 26)  
Space: O(26)

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
