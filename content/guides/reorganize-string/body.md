## Even slots first

1. Count the letters. If `max count > (n + 1) // 2`, return `""`.
2. Sort the letters by count, descending. Write them one copy at a time into `i = 0, 2, 4, …`; when `i ≥ n`, switch to `i = 1, 3, 5, …`.

The most frequent letter fits in the even slots without wrapping, so its copies are separated. Every other letter has at most `(n + 1) // 2` copies too, and when its run wraps from even to odd slots, its copies still end up two apart.

**Heap version:** repeatedly pop the two most frequent letters, append both, and push them back with counts reduced. That builds the string left to right.

Do not place letters greedily left to right without looking at the counts; you can paint yourself into a corner. Do not skip the feasibility check; `"aaab"` → `""`.

Time: O(n) (26 letters)  
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
