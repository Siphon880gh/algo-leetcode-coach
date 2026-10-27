## Overwrite this node with its successor

Remove Linked List Elements (203) walks from a dummy `head` and skips matches. Reverse Linked List rewires the whole chain. Palindrome Linked List reverses the right half. Here you cannot find the previous pointer, so you cannot `prev.next = node.next`.

Copy `node.next.val` into `node.val`, then `node.next = node.next.next`. The next object is unlinked; the given object now holds the old next value. Do not `return` a new head (the function is void). Do not walk from a fictional `head`. Do not try this on a tail (the problem forbids it: there is no next to copy).

**Time:** O(1)  
**Space:** O(1)

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
