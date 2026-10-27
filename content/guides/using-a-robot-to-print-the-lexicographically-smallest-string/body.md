## Pop when nothing smaller waits

1. `sufmin[i]` = smallest letter of `s[i …]`; `sufmin[n]` = a value above z.
2. For each `i`: push `s[i]`; while the stack’s top ≤ `sufmin[i + 1]`, pop it to the answer.
3. Return the answer.

Examples → azz, abc, addb.

Popping a letter equal to the smallest remaining one is safe, because the copy still in s can follow it. Once s is empty, the sentinel empties the stack. A count array over 26 letters can replace the suffix minimum.

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
