## One pass with a tail pointer

1. `dummy`, `tail = dummy`, `s = 0`.
2. For each node after the head: if value is 0, append `s` at `tail` and reset `s`; else `s += value`.
3. Return `dummy.next`.

Examples → `[4,11]`, `[1,3,4]`.

The list never has two zeros in a row, so every segment is non-empty and no 0 node is emitted. Reusing the zero nodes as result nodes gives O(1) extra space.

Time: O(n)  
Space: O(1) with reuse

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
