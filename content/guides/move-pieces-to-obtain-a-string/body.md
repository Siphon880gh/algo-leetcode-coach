## Pair the pieces in order

1. List the pieces of `start` and `target` with their indices, skipping `_`.
2. If the letter sequences differ, return false.
3. For each pair `(i, j)`: an L needs `i ≥ j`; an R needs `i ≤ j`.
4. Return true.

Examples → true, false, false. Checked against a full search of reachable strings on 500 random cases.

Pieces only move into blanks, so their order is fixed. When the order matches and each piece only needs to move its own way, they can be moved one at a time: Ls from the left, Rs from the right.

Time: O(n)  
Space: O(n), or O(1) with two pointers

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
