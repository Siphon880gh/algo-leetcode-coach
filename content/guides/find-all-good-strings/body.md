## State (i, j, low, high)

1. Precompute the KMP failure function of `evil` and a transition `next(j, c)`.
2. `f(i, j, low, high)`: 0 if `j == len(evil)`; 1 if `i == n`.
3. Letters range from `low ? s1[i] : 'a'` to `high ? s2[i] : 'z'`; recurse with `next(j, c)` and updated flags.
4. Answer `f(0, 0, true, true)` modulo 10⁹ + 7.

`n = 2, "aa".."da", evil "b"` → 51. `"leetcode".."leetgoes", evil "leet"` → 0. `"gx".."gz", evil "x"` → 2.

Do not reset the match to 0 on a mismatch; KMP keeps partial matches such as overlapping prefixes. Do not count strings ≤ s2 and subtract those < s1 without care; the two flags handle both bounds at once.

Time: O(n · |evil| · 26 · 4)  
Space: O(n · |evil| · 4)

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
