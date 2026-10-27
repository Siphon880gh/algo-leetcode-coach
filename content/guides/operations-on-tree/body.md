## State and the three operations

- `owner[x]` = user holding the lock, or 0; `children[p]` built from `parent`.
- `lock(x, u)`: if `owner[x] == 0`, set it to `u`, return true.
- `unlock(x, u)`: if `owner[x] == u`, clear it, return true.
- `upgrade(x, u)`: fail if `owner[x] != 0` or any ancestor (walk `parent`) is locked. DFS the subtree, clearing every locked descendant and noting whether any existed. If none, fail; else set `owner[x] = u`, return true.

Example 1 → `true, false, true, true, true, false`.

Unlock needs the same user; upgrade ignores who locked the descendants. Check the ancestor condition before clearing, so a failed upgrade changes nothing.

Time: lock/unlock O(1); upgrade O(n)  
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
