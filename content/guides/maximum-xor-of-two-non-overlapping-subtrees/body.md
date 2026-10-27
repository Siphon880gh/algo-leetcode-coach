A rooted tree has a value on every node. Pick two subtrees that share no node, and score them by the XOR of their sums. Return the largest score, or 0 if no two such subtrees exist. For instance, a path 0 – 1 – 2 rooted at 0 → 0, since every pair of subtrees nests; a root with value 5 and two leaf children with values 2 and 3 → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Finished subtrees are disjoint

1. One DFS for subtree sums `S[u]`.
2. Second DFS: at `u`, update the best with the trie’s maximum XOR against `S[u]`; visit the children; then insert `S[u]`.
3. Return the best, 0 if nothing was ever compared.

Constructed checks (verified against comparing every disjoint pair on 300 random trees): the cases above → 0, 1.

When u is entered, the trie holds exactly the subtrees that were completed earlier: not ancestors, which are still open, and not descendants, which come later. Every disjoint pair has one finished before the other starts, so each pair is compared once. A trie over the bits of the largest sum answers each query in O(bits).

Time: O(n · bits)  
Space: O(n · bits)

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
