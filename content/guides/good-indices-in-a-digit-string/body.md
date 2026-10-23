You get a string s of digits. An index i is good when some substring ending at i equals the decimal form of i. Return all good indices in increasing order. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One window per index

1. For each i: t = str(i), L = len(t).
2. If L ≤ i + 1 and s[i − L + 1 … i] = t, keep i.
3. Return the kept indices.

Assumed here: the decimal form of i has no leading zeros, so the window length is fixed.

Constructed checks (made-up values, run in code): "0101" → [0, 1]; "333" → []; "00000000010" → [0, 10]. Checked against every substring on 2,000 random strings.

Checking only s[i] against the last digit of i: "00000000000" → [0, 10] instead of [0].

Time: O(n log n)  
Space: O(1) beyond the output

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
