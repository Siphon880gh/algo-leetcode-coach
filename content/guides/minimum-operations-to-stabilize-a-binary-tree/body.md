You get the root of a binary tree whose values can be negative. The tree is stable when every parent and child differ by at most 1. One operation adds or subtracts 1 at any node. Return the fewest operations that make the tree stable. Example: root = [5, 8, 3] needs 3 (8 down to 6 and 3 up to 4). There are up to 5 × 10^4 nodes with values in [−10^5, 10^5]. _(Restated in my own words; the full statement shows when premium is unlocked.)_

## Example first

root = [2, −1, −4].

1. Keep the root at 2: −1 must rise to 1 (2 operations) and −4 to 1 (5 operations). Total 7.
2. Move the root to −2 instead (4 operations). Now −1 is fine and −4 rises to −3 (1 operation). Total 5.

Answer 5. The root can move too.

## Idea

Let f_u(x) be the cheapest cost for u's subtree when u ends at value x:

f_u(x) = |x − val_u| + sum over children c of (min of f_c(y) for y in [x − 1, x + 1])

Each f is convex and piecewise linear, so store it by its breakpoints (the slope trick). Write f(x) = C + ½ · Σ |x − b| over a multiset of 2m breakpoints, m = subtree size. The m smallest form the left half and sit in a max-heap; the rest sit in a min-heap.

## Steps

1. Leaf or not, add |x − val_u| by inserting val_u twice.
2. Before a child joins its parent, apply the window minimum: shift the left half by −1 and the right half by +1 (lazy offsets on the two heaps) and lower C by m, so the minimum value stays the same.
3. Sum the children: merge the smaller pair of heaps into the larger, rebalance so the left half holds the smallest half, and add the C values.
4. At the root, evaluate C + ½ · Σ |x − b| at a median breakpoint.

## Trap

Keeping the root's value and only fixing children. Example 2 then gives 7 instead of 5. Fix: let every node, the root included, move.

Checked: the examples give 3, 5 and 3, and the method matched a DP over every value in range on 300 random small trees.

Time: O(n log² n) with small-into-large merges  
Space: O(n)

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
