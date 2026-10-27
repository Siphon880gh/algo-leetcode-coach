## The span of a most-frequent value

Any subarray with the same degree must contain every copy of some most-frequent value `x`. The shortest such subarray runs from `x`'s first occurrence to its last.

In one pass, fill `first[x]`, `last[x]`, and `count[x]`. Then:

- `degree = max(count)`.
- The answer is the minimum of `last[x] − first[x] + 1` over the `x` with `count[x] == degree`.

You can also update the answer during the pass: when `count[x]` beats the best degree, take its span; when it ties, take the smaller span.

Do not return the degree itself; the answer is a length. Do not consider only one most-frequent value; ties can have different spans, as in `[1,2,2,3,1]` → 2.

Time: O(n)  
Space: O(n)

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
