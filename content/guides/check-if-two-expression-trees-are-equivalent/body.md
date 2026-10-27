Given two binary expression trees whose leaves are single-letter variables and whose internal nodes use only the + operator, return true if they evaluate to the same value for every assignment of the variables. For instance, a+(b+c) and (b+c)+a are equivalent; a+b and a+c are not. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Leaf counts

1. DFS the first tree: `cnt[leaf] += 1`.
2. DFS the second: `cnt[leaf] −= 1`.
3. Return whether every count is 0 (26 letters).

Constructed check: `a+(b+c)` vs `(b+c)+a` → true. `a+b` vs `a+c` → false. `a+a` vs `a` → false.

Follow-up with subtraction: carry a sign down the DFS (flip it on a − node's right child) and add `sign` to the count. Do not compare tree shapes.

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
