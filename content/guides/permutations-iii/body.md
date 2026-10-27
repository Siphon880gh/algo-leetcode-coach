Given n, list every permutation of 1 … n in which each pair of neighbors has one odd and one even number, in lexicographic order. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Build in order

This assumes n is small (about 10); the output alone has 2 · ((n / 2)!)² permutations for even n.

1. bt(path): if full, record a copy.
2. For x = 1 … n unused with x and the last element of different parity (any x first): add, recurse, remove.

Constructed checks (run in code): n = 3 → [1, 2, 3], [3, 2, 1]; n = 4 → 8; n = 5 → 12; n = 10 → 28,800. Checked against filtering every permutation for n ≤ 8.

Always starting with an odd number: n = 4 → 4 instead of 8.

Time: O(n · output)  
Space: O(n) besides the output

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
