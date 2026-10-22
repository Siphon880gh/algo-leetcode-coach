A rope binary tree represents a string. Each leaf holds a non-empty string; each internal node has one or two children and stores the total length of the string it represents, which is its left child’s string followed by its right child’s string. Given the root and k, return the k-th character of the whole string. The node fields and indexing are in the official statement; the examples here count from 1. For instance, if the left subtree spells ab, cd and the right subtree spells xyz, the string is abcdxyz and k = 5 → x. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Walk down

1. `u = root`.
2. While u is internal: `L` = length of the left child (stored length if internal, string length if a leaf, 0 if missing). If `k ≤ L`, go left; else `k −= L`, go right.
3. Return the k-th character of u’s string.

Constructed checks (simulated in code): every k from 1 to 7 on the tree above matches abcdxyz.

An internal node’s own string is empty, so reading the left child’s string length there gives 0 and sends the walk the wrong way; on the tree above, k = 2 then lands on y instead of b.

Time: O(height)  
Space: O(1)

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
