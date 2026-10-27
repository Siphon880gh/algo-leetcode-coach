You get the head of an immutable linked list through an interface with `printValue()` and `getNext()` only. Print every value from the tail back to the head without changing the list. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Print on the way back

```python
def printLinkedListInReverse(head):
    if head:
        printLinkedListInReverse(head.getNext())
        head.printValue()
```

**Other trade-offs:**
- Stack of nodes: O(n) time, O(n) space, no recursion limit.
- O(1) space: count `n`, then for `i` from `n − 1` down to 0, walk `i` steps and print; O(n²) time.
- √n blocks: remember every √n-th node and reverse-print each block with a small stack; O(n) time, O(√n) space.

Do not try to reverse the list; it is immutable. Do not print before recursing; that prints in order.

Time: O(n)  
Space: O(n) recursion

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
