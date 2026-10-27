## Runs that cross the middle

1. Leaf: `pre = suf = best = 1`.
2. Merge `L`, `R` (with `mid` the boundary): `best = max(L.best, R.best, L.suf + R.pre if s[mid − 1] = s[mid])`; `pre = L.pre + R.pre` when `L` is one full run and characters match, else `L.pre`; `suf` symmetric.
3. Each query: set the character, update the leaf and its ancestors, read `root.best`.

Examples → `[3,3,4]`, `[2,3]`. Checked against recomputing every run after each query on 300 random cases.

n and k reach 10^5, so a full rescan per query is 10^10 steps; the tree makes each one O(log n).

Time: O((n + k) log n)  
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
