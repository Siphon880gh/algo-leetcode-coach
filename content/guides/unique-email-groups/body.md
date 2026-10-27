You get a list of email addresses. Two addresses are in the same group when they match after normalizing: in the local part (before @), dots are ignored and everything from the first + on is dropped, and letter case does not matter. Return the number of groups. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Normalize

1. Split at '@' into local and domain.
2. local: cut at the first '+', remove dots, lowercase. domain: lowercase.
3. Add local + '@' + domain to a set; return its size.

Assumed here: the rules are exactly those in the restatement; keep the '@' so local "a" + domain "bc.io" differs from "ab" + "c.io".

Constructed checks (made-up addresses, run in code): ["A.b+x@Mail.com", "ab@mail.com", "ab@mail.org"] → 2; ["x.y@a.io", "xy+1@a.io", "x@ya.io"] → 2.

Comparing case-sensitively: the first check → 3 instead of 2.

Time: O(total length)  
Space: O(total length)

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
