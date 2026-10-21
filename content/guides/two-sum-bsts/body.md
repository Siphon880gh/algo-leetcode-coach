Given the roots of two binary search trees and a target, return whether there is a node in the first tree and a node in the second whose values add up to the target. For instance, trees with values {1, 2, 4} and {0, 1, 3} and target 5 give true (2 + 3), and target 18 gives false. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Set and lookup

1. Traverse tree 1 and store its values in `seen`.
2. Traverse tree 2; if `target − v` is in `seen`, return true.
3. Return false.

**Space-light variant:** in-order ascending over tree 1 and descending over tree 2 with stacks, moving like two-pointer two-sum.

Do not search both values in the same tree; one node must come from each. Do not do a BST search in tree 1 for each node of tree 2 without noting the cost; it is O(n · h).

Time: O(n1 + n2)  
Space: O(n1) for the set, or O(h1 + h2) with iterators

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
