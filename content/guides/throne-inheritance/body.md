## Lazy order

1. `birth(p, c)`: append `c` to `children[p]`.
2. `death(x)`: add `x` to `dead`.
3. `getInheritanceOrder()`: preorder from the king; output a name only if it is not dead; always recurse into children.

Example: after six births → `king, andy, matthew, bob, alex, asha, catherine`; after `death("bob")` → `king, andy, matthew, alex, asha, catherine`.

Do not remove dead people from the tree; their children still inherit through them. Recursion depth can reach the number of people; use an explicit stack if that matters.

Time: O(1) birth/death, O(n) order  
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
