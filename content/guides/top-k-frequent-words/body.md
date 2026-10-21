## The comparison is the whole problem

Count with a hash map. The order is: higher count first, and on ties, alphabetically smaller first.

- **Sort:** sort the distinct words by `(−count, word)` and take the first `k`. O(m log m) for `m` distinct words.
- **Heap of size k:** keep the `k` best seen so far, with the **worst** at the top: smallest count, and on ties the alphabetically **larger** word. Push each word and pop when the size passes `k`. Then pop everything and reverse. O(m log k).

Bucket sort by count is also O(n) if you sort each bucket alphabetically.

Do not use a plain min-heap on `(count, word)`; tuples compare the words ascending, which evicts the wrong word on ties. Do not forget to reverse the heap output.

Time: O(n + m log k)  
Space: O(m)

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
