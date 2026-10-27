## Pieces slide through X, never through each other

L and R never pass each other, so the sequence of non-X characters is fixed. Each L can only move left, and each R only right.

Two pointers `i` over `start`, `j` over `end`:

1. Skip X in both.
2. If one string is done and the other is not, return false.
3. `start[i] ≠ end[j]` → false.
4. `start[i] == 'L'` and `i < j` → false (it would have to move right).
5. `start[i] == 'R'` and `i > j` → false (it would have to move left).
6. Advance both.

Return true when both finish together.

Do not simulate swaps with BFS; the string can be 10⁴ long. Do not compare only the non-X sequences; an L that needs to move right fails even when the sequences match.

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
