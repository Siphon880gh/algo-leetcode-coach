## Three states

`dfs(node)` returns:

- `0`: not covered (needs the parent to cover it).
- `1`: has a camera.
- `2`: covered, no camera.

Rules:

- `None` → 2 (an empty child needs nothing).
- If either child returns 0: place a camera here, `cams += 1`, return 1.
- Else if either child returns 1: return 2.
- Else return 0.

After the call, if the root returns 0, add one more camera.

Pushing cameras upward is optimal: a camera at a leaf's parent covers the leaf, the parent, and the grandparent, a superset of what the leaf camera would cover.

Do not place cameras at leaves. Do not forget the root's final check.

Time: O(n)  
Space: O(h)

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
