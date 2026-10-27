## Example first

words = ["bad", "bag", "fig", "fed"], target = [3, 1, 0, 2]. Positions in target: fed → 0, bag → 1, bad → 2, fig → 3.

1. Visit the "f" branch first, with "fed" before "fig": positions 0, 3.
2. Then the "b" branch, with "bag" before "bad": positions 1, 2.
3. Traversal positions [0, 3, 1, 2] have 2 inversions: (3, 1) and (3, 2). Answer 2.

## Where inversions live

At each trie node:

1. A marked node is recorded before its whole subtree, so it adds a fixed cost: how many descendants have a smaller position.
2. Pairs inside one child subtree are that child's problem.
3. Pairs across two child subtrees depend only on which child goes first. cost(A before B) = pairs a in A, b in B with pos[a] > pos[b].

## Steps

1. Build the trie and store each word's position in target.
2. Post-order: each node returns the sorted positions in its subtree.
3. For every pair of children, compute cost both ways by merging their sorted lists.
4. There are at most 10 children (letters a to j). Bitmask DP: dp[mask with c] = min(dp[mask] + sum over d in mask of cost(d before c)). Add dp[all].
5. Add the node's own mark cost and pass the merged list up.

## Trap

Ordering children greedily by their smallest position. For ["ab", "aa", "a", "b"] with target [0, 3, 1, 2] that gives 4 instead of 3. Fix: compare pairwise costs and search orders.

Checked: the examples give 2 and 1, and the method matched trying every child order on 200 random small tries.

Time: O(n · L · d + T · 2^d · d) with d ≤ 10 children and T trie nodes  
Space: O(n · L)

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
