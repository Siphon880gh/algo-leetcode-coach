`s` has up to 3e4 characters: digits, `'('`, `')'`, and `'-'`. It is an integer followed by zero, one, or two parenthesized subtrees, each in the same format; the first parenthesized subtree is the left child. Return the tree. `"4(2(3)(1))(6(5))"` → `[4,2,6,3,1,5]`. `"-4(2(3)(1))(6(5)(7))"` → `[-4,2,6,3,1,5,7]`. `""` → null. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Recursive descent

Keep a shared index `i`. `parse()`:

1. Read an optional `'-'`, then all digits, to get the value. Create the node.
2. If `s[i] == '('`: skip it, `node.left = parse()`, skip the `')'`.
3. If `s[i] == '('` again: skip it, `node.right = parse()`, skip the `')'`.
4. Return the node.

Each character is read once, so the whole parse is O(n). Return null for an empty string.

Stack version: push nodes as numbers are read; on `')'` pop. A new node becomes the left child of the stack top if it has no left yet, else the right child.

Construct String from Binary Tree (606) goes the other way.

Do not read only one digit — values can be multi-digit and negative. Do not split the string on parentheses with slices for each call; repeated slicing makes it O(n²).

Time: O(n)  
Space: O(h) recursion (O(n) worst case)

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
