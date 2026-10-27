## Smallest cookie that works

Sort `g` and `s`. Pointer `i` on children, `j` on cookies. While both remain: if `s[j] >= g[i]`, feed child `i` and move both pointers; otherwise this cookie is too small for every remaining child, so move `j` only. The answer is `i` at the end.

Why it is optimal: the least greedy child is the easiest to satisfy. Giving it the smallest cookie that works keeps every bigger cookie for greedier children. Using a bigger cookie than needed can only hurt.

Candy (135) gives candies under neighbor rules — a different greedy. Boats to Save People (881) pairs from both ends.

Do not hand the biggest cookie to the least greedy child. Do not skip children when a cookie is too small — skip the cookie.

Time: O(n log n + m log m)  
Space: O(1) besides sorting

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
