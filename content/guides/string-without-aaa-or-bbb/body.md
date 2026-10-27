## Majority first, with a brake

While `a > 0` or `b > 0`:

- If the last two characters are `"aa"`, write `b`.
- Else if the last two are `"bb"`, write `a`.
- Else write whichever letter has more left (`a` on ties).

Decrement the count of the letter written.

The problem guarantees an answer exists, so the forced letter always has a copy left.

Do not alternate strictly; with `a = 4, b = 1` you need `"aabaa"`. Do not write the minority first; the majority would end up in a block of three.

Time: O(a + b)  
Space: O(a + b) for the result

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
