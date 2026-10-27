## Index map plus a running best

1. `pos[s] = i` for every string in `list1`.
2. For each `j, s` in `list2` with `s` in `pos`: let `t = pos[s] + j`.
   - If `t < best`, set `best = t` and `ans = [s]`.
   - If `t == best`, append `s`.

You can stop scanning once `j > best`, because every later sum is at least `j`.

Do not return only the first common string; every string that ties the minimum sum belongs in the answer. Do not compare every pair of strings; the map makes each lookup O(1).

Time: O(m + n) lookups (times the string length)  
Space: O(m)

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
